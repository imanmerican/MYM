@extends('expenses.index')

@section('content')
<div class="container">
    <h1>Expenses</h1>

    <div class="text-end mb-3">
        <a href="{{ route('expenses.create') }}" class="btn btn-success">Add Expense</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Amount (RM)</th>
                <th>Date</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->title }}</td>
                <td>{{ number_format($expense->amount, 2) }}</td>
                <td>{{ $expense->expense_date }}</td>
                <td>{{ $expense->notes }}</td>
                <td>
                    <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

            <tr>
                <td colspan="1" class="text-end"><strong>Total:</strong></td>
                <td><strong>RM {{ number_format($totalExpenses, 2) }}</strong></td>
                <td colspan="3"></td>
            </tr>

        </tbody>
    </table>
</div>
@endsection