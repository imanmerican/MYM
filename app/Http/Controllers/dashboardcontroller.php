<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Expenses;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
    //
    public function index()
    {
        $totalSales = Sale::sum(DB::raw('quantity * price_per_unit'));
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();
        $totalExpenses = Expenses::sum('amount');

        $salesTotal = Sale::sum(DB::raw('quantity * price_per_unit'));
        $expensesTotal = Expenses::sum('amount');

        $recentSales = Sale::latest()->take(5)->get(); // Adjust as necessary
        $expenses = Expenses::all(); // Adjust according to your model

        $newCustomers = Customer::where('created_at', '>', now()->subDays(30))->count();

        return view('dashboard', compact(
            'totalSales',
            'totalProducts',
            'totalCustomers',
            'totalExpenses',
            'salesTotal',
            'expensesTotal',
            'recentSales',
            'expenses',
            'newCustomers'
        ));
    }

    public function getSalesBreakdown()
    {
        $salesData = DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->select('products.name as category', DB::raw('SUM(sales.quantity * sales.price_per_unit) as value'))
            ->whereMonth('sales.created_at', now()->month)
            ->whereYear('sales.created_at', now()->year)
            ->groupBy('products.name')
            ->get();

        return response()->json($salesData);
    }
   
}
