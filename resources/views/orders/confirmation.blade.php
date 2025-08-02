@extends('layout')

@section('title', 'Order Confirmed')

@section('content')
    <p>Thank you! Your order has been placed.</p>
    <a href="{{ route('products.index') }}">Back to Products</a>
@endsection
