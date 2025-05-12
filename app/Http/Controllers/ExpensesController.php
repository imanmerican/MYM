<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    //
    public function index()
    {
        
        $expenses = Expenses::orderBy('expense_date', 'desc')->get();
        $totalExpenses = $expenses->sum('amount');
        return view('expenses.dashboard', compact('expenses','totalExpenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        Expenses::create($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense recorded.');
    }

    public function edit(Expenses $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expenses $expense)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense updated.');
    }

    public function destroy(Expenses $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted.');
    }
}
