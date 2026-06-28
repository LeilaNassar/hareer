<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    private float $deliveryFee = 4.00;

    private function guestToken()
    {
        if (request()->cookie('hareer_guest_cart')) {
            return request()->cookie('hareer_guest_cart');
        }

        return (string) Str::uuid();
    }

    private function cartCookie()
    {
        return cookie('hareer_guest_cart', $this->guestToken(), 60 * 24 * 365);
    }

    private function cartQuery()
    {
        if (Auth::check()) {
            return CartItem::with('product')
                ->where('user_id', Auth::id());
        }

        return CartItem::with('product')
            ->where('guest_token', $this->guestToken());
    }

    public function index()
    {
        $cartItems = $this->cartQuery()
            ->whereHas('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.')
                ->withCookie($this->cartCookie());
        }

        foreach ($cartItems as $item) {
            if (! $item->product || $item->product->isSoldOut()) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'One of your selected products is no longer available.')
                    ->withCookie($this->cartCookie());
            }

            if ($item->quantity > $item->product->stock) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', $item->product->name . ' does not have enough stock.')
                    ->withCookie($this->cartCookie());
            }

            $hasSizeGuide = $item->product->size_guides && count($item->product->size_guides);

            if ($hasSizeGuide && ! $item->selected_size) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'Please choose the suitable size for ' . $item->product->name . '.')
                    ->withCookie($this->cartCookie());
            }
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->finalprice() * $item->quantity;
        });

        $deliveryFee = $this->deliveryFee;
        $total = $subtotal + $deliveryFee;

        return response()
            ->view('checkout.index', compact(
                'cartItems',
                'subtotal',
                'deliveryFee',
                'total'
            ))
            ->withCookie($this->cartCookie());
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $cartItems = $this->cartQuery()
            ->whereHas('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.')
                ->withCookie($this->cartCookie());
        }

        $order = null;
        $whatsappItems = [];
        $subtotal = 0;
        $deliveryFee = $this->deliveryFee;
        $total = 0;

        try {
            DB::transaction(function () use ($validated, $cartItems, &$order, &$whatsappItems, &$subtotal, &$total, $deliveryFee) {
                foreach ($cartItems as $item) {
                    $product = Product::where('id', $item->product_id)
                        ->lockForUpdate()
                        ->first();

                    if (! $product) {
                        throw new \Exception('A product in your cart is no longer available.');
                    }

                    if ($product->isSoldOut()) {
                        throw new \Exception($product->name . ' is sold out.');
                    }

                    if ($item->quantity > $product->stock) {
                        throw new \Exception($product->name . ' does not have enough stock.');
                    }

                    $hasSizeGuide = $product->size_guides && count($product->size_guides);

                    if ($hasSizeGuide && ! $item->selected_size) {
                        throw new \Exception('Please choose the suitable size for ' . $product->name . '.');
                    }

                    if ($hasSizeGuide && ! in_array($item->selected_size, $product->size_guides)) {
                        throw new \Exception('The selected size for ' . $product->name . ' is no longer available.');
                    }

                    $price = $product->finalprice();
                    $itemSubtotal = $price * $item->quantity;

                    $subtotal += $itemSubtotal;

                    $whatsappItems[] = [
                        'name' => $product->name,
                        'selected_size' => $item->selected_size,
                        'quantity' => $item->quantity,
                        'price' => $price,
                        'subtotal' => $itemSubtotal,
                    ];
                }

                $total = $subtotal + $deliveryFee;

                $order = Order::create([
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'notes' => $validated['notes'] ?? null,
                    'total' => $total,
                    'status' => 'pending',
                ]);

                foreach ($cartItems as $item) {
                    $product = Product::where('id', $item->product_id)
                        ->lockForUpdate()
                        ->first();

                    $price = $product->finalprice();
                    $itemSubtotal = $price * $item->quantity;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'selected_size' => $item->selected_size,
                        'price' => $price,
                        'quantity' => $item->quantity,
                        'subtotal' => $itemSubtotal,
                    ]);
                }

                if (Auth::check()) {
                    CartItem::where('user_id', Auth::id())->delete();
                } else {
                    CartItem::where('guest_token', $this->guestToken())->delete();
                }
            });
        } catch (\Exception $exception) {
            return redirect()
                ->route('cart.index')
                ->with('error', $exception->getMessage())
                ->withCookie($this->cartCookie());
        }

        $message = "Hello, I want to order:\n\n";

        foreach ($whatsappItems as $item) {
            $sizeText = $item['selected_size']
                ? " | Size: {$item['selected_size']}"
                : "";

            $message .= "- {$item['name']}{$sizeText} x{$item['quantity']} → $" . number_format($item['subtotal'], 2) . "\n";
        }

        $message .= "\nSubtotal: $" . number_format($subtotal, 2);
        $message .= "\nDelivery: $" . number_format($deliveryFee, 2) . " all over Lebanon";
        $message .= "\nTotal: $" . number_format($total, 2);

        $message .= "\n\nMy name: {$validated['name']}";
        $message .= "\nPhone: {$validated['phone']}";
        $message .= "\nAddress: {$validated['address']}";

        if (! empty($validated['notes'])) {
            $message .= "\nNotes: {$validated['notes']}";
        }

        if ($order) {
            $message .= "\n\nOrder ID: #{$order->id}";
        }

        $storePhone = '96170260654';

        $whatsappUrl = 'https://wa.me/' . $storePhone . '?text=' . urlencode($message);

        return redirect()->away($whatsappUrl);
    }
}