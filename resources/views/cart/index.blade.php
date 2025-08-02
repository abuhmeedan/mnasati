@extends('layout')

@section('title', 'Your Cart')
@php
    $cartCollection = collect($cart);
@endphp
@section('content')
    @if ($cartCollection->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <ul>
            @foreach ($cartCollection as $item)
                <li>
                    {{ $item->product->name }} (x{{ $item->quantity }}) – ${{ $item->total }}
                </li>
            @endforeach
        </ul>
        <p><strong>Total: ${{ $cart->sum(fn($item) => $item->product->price * $item->quantity) }}</strong></p>

        <a href="{{ route('checkout.index') }}">Proceed to Checkout</a>
    @endif
@endsection
