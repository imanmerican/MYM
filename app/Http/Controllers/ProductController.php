<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }
    
    public function create()
    {
        return view('product.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'nullable|string',
            'price_per_unit' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
    
        Product::create($request->all());
    
        return redirect()->route('product.index')->with('success', 'Product added successfully.');
    }
    
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }
    
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'nullable|string',
            'price_per_unit' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}
