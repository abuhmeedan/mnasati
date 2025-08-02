@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Order #{{ $order->id }}</h1>
    <p><strong>User ID:</strong> {{ $order->user_id }}</p>
    <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

    <h3 class="mt-4">Items</h3>

    @if($order->items->isEmpty())
        <p>No items in this order.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_id }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection
