@extends('sales.index')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Sales</h2>



    <div class="mb-3 text-end">
        <a href="{{ route('sales.create') }}" class="btn btn-success">Add New Sale</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-lg p-4">
        <div class="card-body">
            {{-- Filter Form --}}
            <form method="GET" action="{{ route('sales.index') }}" class="row g-3 mb-4">
                <div class="col-md-3">
                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="{{ request('product_name') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" value="{{ request('customer_name') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="sale_date" class="form-control" value="{{ request('sale_date') }}">
                </div>
                <div class="col-md-3 text-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Quantity (KG)</th>
                        <th>Price per KG</th>
                        <th>Total Sale</th>
                        <th>Sale Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                    <tr>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>RM {{ number_format($sale->price_per_unit, 2) }}</td>
                        <td>RM {{ number_format($sale->total_sale, 2) }}</td>
                        <td>{{ $sale->sale_date }}</td>
                        <td>
                            <a href="{{ route('sales.edit', $sale) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('sales.destroy', $sale) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No sales found.</td>
                    </tr>
                    @endforelse

                    <tr>
                        <td colspan="2" class="text-end"><strong>Total Quantity:</strong></td>
                        <td><strong>{{ $totalQuantity }} kg</strong></td>
                        <td class="text-end"><strong>Total Sales:</strong></td>
                        <td><strong>RM {{ number_format($totalSalesAmount, 2) }}</strong></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection