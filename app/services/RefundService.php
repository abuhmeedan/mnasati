<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class RefundService
{
    public function refundOrder(Order $order)
    {
        DB::transaction(function () use ($order) {
            \logger()->info('Refunding order', ['order_id' => $order->items]);
            foreach ($order->items as $item) {
                $item->product->increment('stock_quantity', $item->quantity);
            }

            $order->update(['is_refunded' => true]);
        });
    }
}
