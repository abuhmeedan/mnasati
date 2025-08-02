<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function checkout()
    {
        $order = app(OrderService::class)->processCheckout();
        return redirect('/')->with('success', 'Order placed.');
    }

    public function showCheckout()
    {
        $cartItems = \App\Models\CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('orders.checkout', compact('cartItems', 'total'));
    }
}
