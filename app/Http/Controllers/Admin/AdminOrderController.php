<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items');

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,delivered,cancelled'],
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        if ($oldStatus === $newStatus) {
            return back()->with('success', 'Order status updated.');
        }

        $stockReducedStatuses = ['confirmed', 'delivered'];

        $wasStockReduced = in_array($oldStatus, $stockReducedStatuses);
        $shouldReduceStock = in_array($newStatus, $stockReducedStatuses);

        try {
            DB::transaction(function () use ($order, $newStatus, $wasStockReduced, $shouldReduceStock) {
                $order->load('items');

                /*
                    Case 1:
                    Order is moving from pending/cancelled to confirmed/delivered.
                    Reduce stock now.
                */
                if (! $wasStockReduced && $shouldReduceStock) {
                    foreach ($order->items as $item) {
                        $product = Product::where('id', $item->product_id)
                            ->lockForUpdate()
                            ->first();

                        if (! $product) {
                            throw new \Exception($item->product_name . ' no longer exists.');
                        }

                        if ($product->stock < $item->quantity) {
                            throw new \Exception($product->name . ' does not have enough stock.');
                        }

                        $product->decrement('stock', $item->quantity);
                    }
                }

                /*
                    Case 2:
                    Order is moving from confirmed/delivered back to pending/cancelled.
                    Restore stock.
                */
                if ($wasStockReduced && ! $shouldReduceStock) {
                    foreach ($order->items as $item) {
                        $product = Product::where('id', $item->product_id)
                            ->lockForUpdate()
                            ->first();

                        if ($product) {
                            $product->increment('stock', $item->quantity);
                        }
                    }
                }

                $order->update([
                    'status' => $newStatus,
                ]);
            });
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('success', 'Order status updated.');
    }
}