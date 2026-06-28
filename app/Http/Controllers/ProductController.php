<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        $categories = Category::orderBy('name')->get();

        /*
            Featured products for home.
            Only in-stock products appear on the homepage.
        */
        $products = Product::with('category')
            ->where('stock', '>', 0)
            ->latest()
            ->take(12)
            ->get();

        /*
            Sale products for home sale slider.
            Only in-stock discounted products.
        */
        $saleProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->whereNotNull('discount_price')
            ->whereColumn('discount_price', '<', 'price')
            ->latest()
            ->take(10)
            ->get();

        return view('home', compact(
            'products',
            'categories',
            'saleProducts'
        ));
    }

    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $hasFilters =
            $request->filled('category') ||
            $request->filled('sort') ||
            $request->boolean('sale');

        /*
            Products shown only after filters are applied.
            Sold-out products can still appear in filtered results,
            because your Blade already shows Sold Out correctly.
        */
        $productsQuery = Product::with('category');

        if ($request->filled('category')) {
            $productsQuery->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        if ($request->boolean('sale')) {
            $productsQuery
                ->whereNotNull('discount_price')
                ->whereColumn('discount_price', '<', 'price');
        }

        if ($request->sort === 'price_low') {
            $productsQuery->orderByRaw('COALESCE(discount_price, price) ASC');
        } elseif ($request->sort === 'price_high') {
            $productsQuery->orderByRaw('COALESCE(discount_price, price) DESC');
        } else {
            $productsQuery->latest();
        }

        $products = $productsQuery->get();

        /*
            Best Selling Pieces.
            Only in-stock products.
        */
        $bestSellingIds = OrderItem::select('product_id')
            ->selectRaw('SUM(quantity) as sold_count')
            ->groupBy('product_id')
            ->orderByDesc('sold_count')
            ->take(12)
            ->pluck('product_id');

        $bestSellingProducts = Product::with('category')
            ->whereIn('id', $bestSellingIds)
            ->where('stock', '>', 0)
            ->get()
            ->sortBy(function ($product) use ($bestSellingIds) {
                return array_search($product->id, $bestSellingIds->toArray());
            })
            ->take(8)
            ->values();

        /*
            If there are no orders yet, show latest in-stock products.
        */
        if ($bestSellingProducts->isEmpty()) {
            $bestSellingProducts = Product::with('category')
                ->where('stock', '>', 0)
                ->latest()
                ->take(8)
                ->get();
        }

        /*
            Fresh / Restock section.
            Shows latest in-stock products not already in Best Selling.
        */
        $bestSellingProductIds = $bestSellingProducts->pluck('id');

        $restockProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->whereNotIn('id', $bestSellingProductIds)
            ->latest()
            ->take(8)
            ->get();

        return view('products.index', compact(
            'categories',
            'products',
            'bestSellingProducts',
            'restockProducts',
            'hasFilters'
        ));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'images']);

        return view('products.show', compact('product'));
    }
}