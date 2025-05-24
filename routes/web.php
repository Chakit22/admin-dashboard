<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// All routes should use web middleware
Route::middleware('web')->group(function () {
    // Define the welcome route
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    // Include sub-routes
    require __DIR__.'/web/dashboard.php';
    require __DIR__.'/web/products.php';
    require __DIR__.'/web/profile.php';
    require __DIR__.'/web/order.php';
    
    // Include authentication routes last
    require __DIR__.'/auth.php';
});