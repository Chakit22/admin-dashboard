<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Fields: customer_name, total_price
    protected $fillable = ['name', 'email', 'phone', 'address', 'total_price'];
}
