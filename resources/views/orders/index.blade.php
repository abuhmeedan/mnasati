@extends('layouts.app')

@section('title', 'Admin – Orders')

@section('content')
<div class="container py-5 d-flex justify-content-center" style="background: linear-gradient(135deg, #f8fafc 0%, #e2eafc 100%); min-height: 100vh;">
    <div class="w-100 shadow-lg rounded-4 p-4" style="max-width: 960px; background: #fff;">
        <h1 class="text-center mb-4 fw-bold" style="color: #2c3e50;">Orders List</h1>

        @if ($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center rounded-3 overflow-hidden" style="box-shadow: 0 2px 8px rgba(44,62,80,0.08);">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Order #</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="fw-semibold">{{ $order->id }}</td>
                                <td class="text-primary">${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if ($order->is_refunded)
                                        <span class="badge bg-danger px-3 py-2 fs-6">Refunded</span>
                                    @else
                                        <span class="badge bg-success px-3 py-2 fs-6">Completed</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$order->is_refunded)
                                        <form method="POST" action="{{ route('admin.orders.refund', $order->id) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning rounded-pill px-4">Refund</button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-secondary rounded-pill px-4" disabled>N/A</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        @else
            <div class="alert alert-info text-center fs-5 rounded-3 shadow-sm">No orders found.</div>
        @endif
    </div>
</div>
@endsection
