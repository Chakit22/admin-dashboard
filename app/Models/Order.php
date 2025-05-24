<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    // Fields: customer_name, total_price
    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'total_amount',
        'shipping_address'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2'
    ];

    /**
     * Get the products in this order
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price_at_time')
            ->withTimestamps();
    }
}
