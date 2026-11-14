
@extends('orders.layout')

@section('content')

<div class="card mt-5">

    <h2 class="card-header">Orders Management</h2>

    <div class="card-body">

        @session('success')
            <div class="alert alert-success" role="alert">
                {{ $value }}
            </div>
        @endsession

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">

            <a class="btn btn-success btn-sm"
               href="{{ route('orders.create') }}">
                <i class="fa fa-plus"></i> Create New Order
            </a>

        </div>

        <table class="table table-bordered table-striped mt-4">

            <thead>
                <tr>
                    <th width="60px">No</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Revenue</th>
                    <th width="250px">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($orders as $order)

                    <tr>

                        <td>{{ $order->id }}</td>

                        {{-- Customer --}}
                        <td>
                            {{ $order->user->name ?? 'Unknown User' }}
                        </td>

                        {{-- Total Price --}}
                        <td>
                            {{ number_format($order->total_price, 2) }}
                        </td>

                        {{-- Revenue --}}
                        <td>
                            <span class="text-success">
                                {{ number_format($order->revenue, 2) }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td>

                            <form action="{{ route('orders.destroy', $order->id) }}"
                                  method="POST">

                                <a class="btn btn-info btn-sm"
                                   href="{{ route('orders.show', $order->id) }}">
                                    <i class="fa-solid fa-list"></i> Show
                                </a>

                                <a class="btn btn-primary btn-sm"
                                   href="{{ route('orders.edit', $order->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this order?')">

                                    <i class="fa-solid fa-trash"></i> Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            There are no orders.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}

    </div>

</div>

@endsection
