
@extends('orders.layout')

@section('content')

<div class="card mt-5">

    <h2 class="card-header">
        Order Details #{{ $order->id }}
    </h2>

    <div class="card-body">

        {{-- Back Button --}}
        <div class="d-flex justify-content-end mb-3">

            <a class="btn btn-primary btn-sm"
               href="{{ route('orders.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>

        </div>

        {{-- Customer Information --}}
        <div class="card mb-4">

            <div class="card-header">
                <strong>Customer Information</strong>
            </div>

            <div class="card-body">

                <p>
                    <strong>Customer Name:</strong>
                    {{ $order->user->name ?? 'Unknown User' }}
                </p>

                <p>
                    <strong>Email:</strong>
                    {{ $order->user->email ?? 'N/A' }}
                </p>

                <p>
                    <strong>Order ID:</strong>
                    {{ $order->id }}
                </p>

            </div>

        </div>

        {{-- Order Products --}}
        <div class="card mb-4">

            <div class="card-header">
                <strong>Order Products</strong>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Cost</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($orderitems as $item)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $item->product->name ?? 'Deleted Product' }}
                                </td>

                                <td>
                                    {{ number_format($item->product->price ?? 0, 2) }}
                                </td>

                                <td>
                                    {{ number_format($item->product->cost ?? 0, 2) }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    No products in this order.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Order Summary --}}
        <div class="card">

            <div class="card-header">
                <strong>Order Summary</strong>
            </div>

            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-md-6">
                        <strong>Total Price:</strong>
                    </div>

                    <div class="col-md-6">
                        {{ number_format($order->total_price, 2) }}
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <strong>Total Revenue:</strong>
                    </div>

                    <div class="col-md-6 text-success">
                        {{ number_format($order->revenue, 2) }}
                    </div>
                </div>

            </div>

        </div>

        {{-- Edit Order --}}
        <div class="mt-3">

            <a href="{{ route('orders.edit', $order->id) }}"
               class="btn btn-primary">

                <i class="fa-solid fa-pen-to-square"></i>
                Edit Order

            </a>

        </div>

    </div>

</div>

@endsection
