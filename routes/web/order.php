<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('orders')->group(function () {
    // Show all orders
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
}); 