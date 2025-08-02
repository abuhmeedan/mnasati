@extends('layout')

@section('title', 'Products')

@section('content')
    <ul>
        @foreach ($products as $product)
            <li>
                <strong>{{ $product->name }}</strong> – ${{ $product->price }}  
                (Stock: {{ $product->stock_quantity }})
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}">
                    <button type="submit">Add to Cart</button>
                </form>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('cart.index') }}">View Cart</a>
@endsection
