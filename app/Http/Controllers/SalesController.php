<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SalesController extends Controller
{
    //
    // Display all sales
    public function index(Request $request)
    {
        $query = Sale::with('product');

        if ($request->filled('product_name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->product_name . '%');
            });
        }

        if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }

        if ($request->filled('sale_date')) {
            $query->whereDate('sale_date', $request->sale_date);
        }

        // Get the filtered results
        $sales = $query->get();

        // Calculate totals based on the filtered query
        $totalSalesAmount = $query->sum(DB::raw('quantity * price_per_unit'));
        $totalQuantity = $query->sum('quantity'); // <- Add this line

        return view('sales.dashboard', compact('sales', 'totalSalesAmount', 'totalQuantity'));
    }

    // Show form to create a new sale
    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();  // Optional: If you want to allow selection of customers
        return view('sales.create', compact('products', 'customers'));
    }

    // Store a new sale
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer',
            'price_per_unit' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        $customer = Customer::find($request->customer_id);
        $totalSale = $request->quantity * $request->price_per_unit;

        Sale::create([
            'product_id' => $request->product_id,
            'customer_id' => $request->customer_id,
            'customer_name' => $customer->name,
            'quantity' => $request->quantity,
            'price_per_unit' => $request->price_per_unit,
            'total_sale' => $totalSale,
            'sale_date' => $request->sale_date,
        ]);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully!');
    }

    // Show the form to edit an existing sale
    public function edit(Sale $sale)
    {
        $products = Product::all();
        $customers = Customer::all();  // Optional
        return view('sales.edit', compact('sale', 'products', 'customers'));
    }

    // Update the sale
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer',
            'price_per_unit' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        $totalSale = $request->quantity * $request->price_per_unit;

        $sale->update([
            'product_id' => $request->product_id,
            'customer_id' => $request->customer_id,
            'customer_name' => $request->customer_name,
            'quantity' => $request->quantity,
            'price_per_unit' => $request->price_per_unit,
            'total_sale' => $totalSale,
            'sale_date' => $request->sale_date,
        ]);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully!');
    }

    // Delete a sale
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully!');
    }
}
