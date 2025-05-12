<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [dashboardcontroller::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');

    Route::resource('products', ProductController::class);
    Route::resource('sales', SalesController::class);
    Route::resource('expenses', ExpensesController::class);
    Route::resource('customers', CustomerController::class);
   
    Route::get('/dashboard/sales-breakdown', [DashboardController::class, 'getSalesBreakdown']);
    Route::get('/dashboard/expenses-breakdown', [DashboardController::class, 'getExpensesBreakdown']);

});

require __DIR__.'/auth.php';
