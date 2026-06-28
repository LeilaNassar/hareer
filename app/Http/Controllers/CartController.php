<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private function guestToken()
    {
        if (request()->cookie('hareer_guest_cart')) {
            return request()->cookie('hareer_guest_cart');
        }

        return (string) Str::uuid();
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

    private function cartCookie()
    {
        return cookie('hareer_guest_cart', $this->guestToken(), 60 * 24 * 365);
    }

    public function index()
    {
        $cartItems = $this->cartQuery()->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->finalprice() * $item->quantity;
        });

        return response()
            ->view('cart.index', compact('cartItems', 'total'))
            ->withCookie($this->cartCookie());
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'selected_size' => ['nullable', 'string', 'max:255'],
        ]);

        $hasSizeGuide = $product->size_guides && count($product->size_guides);

        if ($hasSizeGuide) {
            if (! $request->filled('selected_size') || ! in_array($request->selected_size, $product->size_guides)) {
                if ($request->expectsJson()) {
                    return response()
                        ->json([
                            'success' => false,
                            'message' => 'Please choose the suitable size before adding to cart.',
                        ], 422)
                        ->withCookie($this->cartCookie());
                }

                return back()
                    ->with('error', 'Please choose the suitable size before adding to cart.')
                    ->withCookie($this->cartCookie());
            }
        }

        if ($product->isSoldOut()) {
            if ($request->expectsJson()) {
                return response()
                    ->json([
                        'success' => false,
                        'message' => 'This product is sold out.',
                    ], 422)
                    ->withCookie($this->cartCookie());
            }

            return back()
                ->with('error', 'This product is sold out.')
                ->withCookie($this->cartCookie());
        }

        $selectedSize = $hasSizeGuide ? $request->selected_size : null;

        $cartItem = $this->cartQuery()
            ->where('product_id', $product->id)
            ->where('selected_size', $selectedSize)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity >= $product->stock) {
                if ($request->expectsJson()) {
                    return response()
                        ->json([
                            'success' => false,
                            'message' => 'You already added the maximum available quantity.',
                        ], 422)
                        ->withCookie($this->cartCookie());
                }

                return back()
                    ->with('error', 'You already added the maximum available quantity.')
                    ->withCookie($this->cartCookie());
            }

            $cartItem->update([
                'quantity' => $cartItem->quantity + 1,
            ]);
        } else {
            CartItem::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'session_id' => Auth::check() ? null : session()->getId(),
                'guest_token' => Auth::check() ? null : $this->guestToken(),
                'product_id' => $product->id,
                'quantity' => 1,
                'selected_size' => $selectedSize,
            ]);
        }

        if ($request->expectsJson()) {
            $cartCount = CartItem::query()
                ->when(Auth::check(), function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->when(! Auth::check(), function ($query) {
                    $query->where('guest_token', $this->guestToken());
                })
                ->sum('quantity');

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Product added to cart.',
                    'cart_count' => $cartCount,
                ])
                ->withCookie($this->cartCookie());
        }

        return back()
            ->with('success', 'Product added to cart.')
            ->withCookie($this->cartCookie());
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($request->quantity > $cartItem->product->stock) {
            return back()
                ->with('error', 'Quantity is more than available stock.')
                ->withCookie($this->cartCookie());
        }

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return back()
            ->with('success', 'Cart updated.')
            ->withCookie($this->cartCookie());
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->delete();

        return back()
            ->with('success', 'Item removed from cart.')
            ->withCookie($this->cartCookie());
    }

    private function authorizeCartItem(CartItem $cartItem): void
    {
        if (Auth::check()) {
            if ($cartItem->user_id !== Auth::id()) {
                abort(403);
            }

            return;
        }

        if ($cartItem->guest_token !== $this->guestToken()) {
            abort(403);
        }
    }
}