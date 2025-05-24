<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    // Show all products
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    
    // Create a new product
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    
    // Delete a product
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
}); 