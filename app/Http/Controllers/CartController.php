<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    public function add(Request $request)
    {
                    logger($request);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        app(CartService::class)->addToCart($request->product_id, $request->quantity);
        return redirect()->route('cart.index')->with('success', 'Added to cart.');
    }

    public function index()
    {
        $cart = app(CartService::class)->getCart();
        return view('cart.index', compact('cart'));
    }

}
