@extends('orders.layout')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Add New Order</h2>

    <div class="card-body">

        <a class="btn btn-primary btn-sm mb-3"
           href="{{ route('orders.index') }}">
            Back
        </a>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            {{-- Select User --}}
            <div class="mb-3">
                <label class="form-label"><strong>User:</strong></label>

                <select name="user_id" class="form-select">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <h5>Order Items</h5>

            <div id="order-items">

                <div class="row mb-3 order-item">
                    <div class="col-md-10">
                        <select name="orderitems[0][product_id]"
                                class="form-select" required>

                            <option value="">Select Product</option>

                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} - {{ $product->price }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="button"
                                class="btn btn-danger remove-item">
                            Remove
                        </button>
                    </div>
                </div>

            </div>

            <button type="button" id="add-item"
                    class="btn btn-primary btn-sm mb-3">
                + Add Product
            </button>

            <br>

            <button type="submit" class="btn btn-success">
                Submit Order
            </button>

        </form>
    </div>
</div>

<script>
    let itemIndex = 1;

    document.getElementById('add-item').addEventListener('click', function () {

        const container = document.getElementById('order-items');

        const newItem = document.createElement('div');

        newItem.classList.add('row', 'mb-3', 'order-item');

        newItem.innerHTML = `
            <div class="col-md-10">
                <select name="orderitems[${itemIndex}][product_id]"
                        class="form-select" required>

                    <option value="">Select Product</option>

                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} - {{ $product->price }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-2">
                <button type="button"
                        class="btn btn-danger remove-item">
                    Remove
                </button>
            </div>
        `;

        container.appendChild(newItem);

        itemIndex++;
    });

    document.getElementById('order-items').addEventListener('click', function(e) {

        if (e.target.classList.contains('remove-item')) {
            const items = document.querySelectorAll('.order-item');

            if (items.length > 1) {
                e.target.closest('.order-item').remove();
            }
        }

    });
</script>

@endsection
