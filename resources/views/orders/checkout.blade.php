@extends('layout')

@section('title', 'Checkout')

@section('content')
    <p>Are you sure you want to checkout?</p>
    <p><strong>Total: ${{ $total }}</strong></p>

    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <button type="submit">Place Order (Cash on Delivery)</button>
    </form>
@endsection
