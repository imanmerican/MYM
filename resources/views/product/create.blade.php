@extends('product.dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">{{ isset($product) ? 'Edit' : 'Add New' }} Product</h2>

    <div class="card shadow-lg p-4">
        <div class="card-body">
            <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST">
                @csrf
                @if(isset($product))
                @method('PUT')
                @endif

                <!-- Product Name -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" value="{{ old('name', $product->name ?? '') }}" required>
                </div>

                <!-- Category -->
                <div class="form-group mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        <option value="Sayur" {{ old('category', $product->category ?? '') == 'Sayur' ? 'selected' : '' }}>Sayur</option>
                        <option value="Ternakkan" {{ old('category', $product->category ?? '') == 'Ternakkan' ? 'selected' : '' }}>Ternakkan</option>
                        <option value="Buah" {{ old('category', $product->category ?? '') == 'Buah' ? 'selected' : '' }}>Buah</option>
                        <option value="Lain-lain" {{ old('category', $product->category ?? '') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                    </select>
                </div>

                <!-- Price -->
                <div class="form-group mb-3">
                    <label for="price_per_unit" class="form-label">Price Per Unit (RM)</label>
                    <input type="number" step="0.01" name="price_per_unit" id="price_per_unit" class="form-control" placeholder="Price" value="{{ old('price_per_unit', $product->price_per_unit ?? '') }}" required>
                </div>

                <!-- Description -->
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Description" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success btn-lg w-100">{{ isset($product) ? 'Update' : 'Save' }}</button>
            </form>
        </div>
    </div>
</div>
@endsection