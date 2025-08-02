<?php

namespace App\Services;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartService
{
    protected $userId;

    public function __construct()
    {
        $this->userId = Auth::id();
    }

    public function addToCart($productId, $quantity)
    {
        if (!$this->userId) {
            throw new \Exception('User must be authenticated to use database cart.');
        }

        // Check if item already in cart
        $cartItem = CartItem::where('user_id', $this->userId)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            CartItem::create([
                'user_id' => $this->userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
    }

    public function getCart()
    {
        if (!$this->userId) {
            return collect();
        }

        return CartItem::with('product')
            ->where('user_id', $this->userId)
            ->get();
    }

    public function clearCart()
    {
        if (!$this->userId) {
            return;
        }

        CartItem::where('user_id', $this->userId)->delete();
    }
}
