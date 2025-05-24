<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // index() - show all products
    public function index()
    {
        $products = Product::latest()->get()->map(function ($product) {
            return [
                ...$product->toArray(),
                'image_url' => $product->image ? Storage::url($product->image) : null
            ];
        });
        
        return Inertia::render('Products', [
            'products' => $products
        ]);
    }

    // store() - create a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'size' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        // New products start as unapproved
        $validated['is_approved'] = false;

        // Creates a new instance of the Product
        Product::create($validated);

        // Get updated products list
        $products = Product::latest()->get()->map(function ($product) {
            return [
                ...$product->toArray(),
                'image_url' => $product->image ? Storage::url($product->image) : null
            ];
        });

        return redirect()->back()->with([
            'success' => 'Sneaker listing created successfully.',
            'products' => $products
        ]);
    }

    public function toggleApproval(Product $product)
    {
        $product->is_approved = !$product->is_approved;
        $product->save();

        return redirect()->back()->with('success', 
            $product->is_approved ? 'Sneaker listing approved.' : 'Sneaker listing unapproved.'
        );
    }

    // destroy() - delete a product
    public function destroy(Product $product)
    {
        try {
            // Delete the image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->delete();
            return redirect()->back()->with('success', 'Sneaker listing deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete sneaker listing.');
        }
    }
}