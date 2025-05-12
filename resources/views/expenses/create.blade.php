@extends('expenses.index')


@section('content')
<div class="container">
    <h1>{{ isset($expense) ? 'Edit' : 'Add' }} Expense</h1>

    <form method="POST" action="{{ isset($expense) ? route('expenses.update', $expense->id) : route('expenses.store') }}">
        @csrf
        @if(isset($expense))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $expense->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount (RM)</label>
            <input type="number" step="0.01" class="form-control" name="amount" value="{{ old('amount', $expense->amount ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="expense_date" class="form-label">Date</label>
            <input type="date" class="form-control" name="expense_date" value="{{ old('expense_date', $expense->expense_date ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" name="notes">{{ old('notes', $expense->notes ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($expense) ? 'Update' : 'Add' }}</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
