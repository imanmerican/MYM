@extends('product.dashboard') 


@section('content')

<h1 class="h1">All Products</h1>
<div class="text-end mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
<table class="table">
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category }}</td>
        <td>RM {{ number_format($product->price_per_unit, 2) }}</td>
        <td>
            <a href="{{ route('products.show', $product) }}">View</a>
            <a href="{{ route('products.edit', $product) }}">Edit</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection