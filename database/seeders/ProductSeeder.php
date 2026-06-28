<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Black Abaya',
            'price' => 40,
            'image' => null,
            'description' => 'Elegant black abaya with a modern modest fit.',
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'White Abaya',
            'price' => 35,
            'image' => 'products/dress1.jpeg',
            'description' => 'Simple white abaya made for clean everyday styling.',
            'stock' => 8,
        ]);

        Product::create([
            'name' => 'Silk Scarf',
            'price' => 15,
            'image' => null,
            'description' => 'Soft silk scarf available for elegant outfits.',
            'stock' => 20,
        ]);

        Product::create([
            'name' => 'Beige Dress',
            'price' => 55,
            'image' => null,
            'description' => 'Minimal beige dress suitable for casual and formal looks.',
            'stock' => 6,
        ]);
    }
}