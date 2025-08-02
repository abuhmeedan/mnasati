<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class OrderService
{
     public function __construct()
    {
        $this->userId = Auth::id();
    }
    public function processCheckout()
    {
        $cart = app(CartService::class)->getCart();
        $total = 0;
        $orderItems = [];
        $order = null;
        
        DB::transaction(function () use ($cart, &$orderItems, &$total) {
            foreach ($cart as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product: {$product->name}");
                }

                $product->decrement('stock_quantity', $item['quantity']);

                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ];

                $total += $product->price * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => $this->userId,
                'total_amount' => $total
            ]);

            \logger('user_id', ['user_id' => $this->userId]);
            foreach ($orderItems as $item) {
                $item['user_id'] = $this->userId;
                $order->items()->create($item);
            }

            app(CartService::class)->clearCart();
        });

        return $order;
    }
}
