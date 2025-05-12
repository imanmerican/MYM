@extends('product.dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Sale</h2>

    <div class="card shadow-lg p-4">
        <div class="card-body">
            <form action="{{ route('sales.update', $sale) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="product_id" class="form-label">Product</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $sale->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ $sale->customer_name }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $sale->quantity }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="price_per_unit" class="form-label">Price per Unit</label>
                    <input type="number" step="0.01" name="price_per_unit" id="price_per_unit" class="form-control" value="{{ $sale->price_per_unit }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="sale_date" class="form-label">Sale Date</label>
                    <input type="date" name="sale_date" id="sale_date" class="form-control" value="{{ $sale->sale_date }}" required>
                </div>

                <button type="submit" class="btn btn-warning btn-lg w-100">Update Sale</button>
            </form>
        </div>
    </div>
</div>
@endsection
