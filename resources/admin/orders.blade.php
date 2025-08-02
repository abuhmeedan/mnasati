@extends('layout')

@section('title', 'Admin – Orders')

@section('content')
    <ul>
        @foreach ($orders as $order)
            <li>
                Order #{{ $order->id }} – ${{ $order->total }} – 
                Status: {{ $order->refunded ? 'Refunded' : 'Completed' }}

                @if (!$order->refunded)
                    <form method="POST" action="{{ route('admin.orders.refund', $order->id) }}">
                        @csrf
                        <button type="submit">Refund</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
