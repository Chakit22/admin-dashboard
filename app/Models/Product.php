<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Product model for a Sneaker Store
class Product extends Model
{
    // Fields: name, price, image_url
    protected $fillable = [
        'name',
        'brand',
        'size',
        'price',
        'image',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'price' => 'decimal:2'
    ];

    /**
     * Get the orders that contain this product
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price_at_time')
            ->withTimestamps();
    }
}
