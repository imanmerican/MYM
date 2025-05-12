@extends('product.dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Product Details</h2>

    <div class="card shadow-lg p-4">
        <div class="card-body">
            <form>
                <!-- Product Name -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" readonly>
                </div>

                <!-- Category -->
                <div class="form-group mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" name="category" id="category" class="form-control" value="{{ $product->category }}" readonly>
                </div>

                <!-- Price -->
                <div class="form-group mb-3">
                    <label for="price_per_unit" class="form-label">Price Per Unit (RM)</label>
                    <input type="text" name="price_per_unit" id="price_per_unit" class="form-control" value="RM {{ number_format($product->price_per_unit, 2) }}" readonly>
                </div>

                <!-- Description -->
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" readonly>{{ $product->description }}</textarea>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-lg w-100">Back to List</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
