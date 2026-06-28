<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('size_guides')->nullable()->after('stock');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('selected_size')->nullable()->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('size_guides');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('selected_size');
        });
    }
};