<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('products')->group(function () {
        // Show all products
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        
        // Create a new product
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        
        // Delete a product
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Toggle approval for a product
        Route::post('/{product}/toggle-approval', [ProductController::class, 'toggleApproval'])->name('products.toggle-approval');
    }); 
}); 