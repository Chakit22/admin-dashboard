<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Fields: name, price, image_url
    protected $fillable = ['name', 'price', 'image_url'];
}
