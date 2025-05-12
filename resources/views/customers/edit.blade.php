@extends('customers.dashboard')

@section('content')
<div class="container">
    <h2>{{ isset($customer) ? 'Edit Customer' : 'Add Customer' }}</h2>

    <form method="POST" action="{{ isset($customer) ? route('customers.update', $customer->id) : route('customers.store') }}">
        @csrf
        @if(isset($customer))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Name*</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $customer->name ?? '') }}" required>
        </div>


        <button type="submit" class="btn btn-success">{{ isset($customer) ? 'Update' : 'Add' }}</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
