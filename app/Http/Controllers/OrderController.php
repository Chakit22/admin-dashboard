<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;

class OrderController extends Controller
{
    // index() - show all orders
    public function index()
    {
        // Mock data for orders
        $orders = [
            [
                'id' => 1,
                'name' => 'Chakit Bhandari',
                'email' => 'chakit@gmail.com',
                'phone' => 1234567890,
                'address' => '38 dempster street, West Footscray, VIC 3012',
                'total_price' => 100,
            ],
            [
                'id' => 2,
                'name' => 'Ajay Kabbur',
                'email' => 'ajay@gmail.com',
                'phone' => 1234567890,
                'address' => '38 dempster street, West Footscray, VIC 3012',
                'total_price' => 200,
            ],
        ];
        return Inertia::render('Orders', [
            'orders' => $orders
        ]);
    }
}