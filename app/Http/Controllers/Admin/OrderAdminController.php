<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\RefundService;   // adjust namespace if different

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function refund(Order $order)
    {
        app(RefundService::class)->refundOrder($order);
        return redirect()->route('admin.orders.index')->with('success', 'Order refunded.');
    }
}
