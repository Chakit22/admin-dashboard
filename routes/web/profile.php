<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Define the profile routes
Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->middleware(['auth', 'verified'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->middleware(['auth', 'verified'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->middleware(['auth', 'verified'])->name('profile.destroy');
});