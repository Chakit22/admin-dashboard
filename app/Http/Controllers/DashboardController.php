<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'total' => Product::count(),
            'pending' => Product::where('is_approved', false)->count(),
            'approved' => Product::where('is_approved', true)->count(),
        ];

        // Get pending products with image URLs
        $pendingProducts = Product::where('is_approved', false)
            ->latest()
            ->get()
            ->map(function ($product) {
                return [
                    ...$product->toArray(),
                    'image_url' => $product->image ? Storage::url($product->image) : null
                ];
            });

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'pendingProducts' => $pendingProducts
        ]);
    }
}