<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'discount_price',
        'image',
        'description',
        'stock',
        'size_guides',
    ];
    protected $casts=['size_guides'=>'array']
;
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}

public function finalPrice()
{
    return $this->discount_price ?? $this->price;
}

public function hasDiscount()
{
    return ! is_null($this->discount_price) && $this->discount_price < $this->price;
}

public function isSoldOut()
{
    return $this->stock <= 0;
}

public function isLowStock()
{
    return $this->stock > 0 && $this->stock <= 3;
}

public function images()
{
    return $this->hasMany(ProductImage::class);
}
}
