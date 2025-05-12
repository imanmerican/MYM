@extends('sales.index')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Add New Sale</h2>

    <div class="card shadow-lg p-4">
        <div class="card-body">
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="product_id" class="form-label">Product</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="customer_id" class="form-label">Customer</label>
                    <select name="customer_id" id="customer_id" class="form-control" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>/KG
                </div>

                <div class="form-group mb-3">
                    <label for="price_per_unit" class="form-label">Price per KG</label>
                    <input type="number" step="0.01" name="price_per_unit" id="price_per_unit" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="sale_date" class="form-label">Sale Date</label>
                    <input type="date" name="sale_date" id="sale_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100">Save Sale</button>
            </form>
        </div>
    </div>
</div>
@endsection