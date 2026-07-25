<?php

namespace App\Http\Controllers;

use App\Models\Product; // Or App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        // Get all products with their categories
        $products = Product::with('category')->latest()->get();
        
        // Get all categories for the "Add Product" dropdown
        $categories = Category::all();

        // Pass BOTH variables to the view
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'product_code' => 'required|string|max:100',
            'cost_price'   => 'required|numeric',
            'selling_price'=> 'required|numeric',
            'stock_qty'    => 'required|integer',
            'status'       => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'category_id'  => $request->category_id,
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'description'  => $request->description,
            'cost_price'   => $request->cost_price,
            'selling_price'=> $request->selling_price,
            'stock_qty'    => $request->stock_qty,
            'barcode'      => $request->barcode,
            'image'        => $imagePath,
            'status'       => $request->status ?? 'active',
        ]);

        return back()->with('status', 'Product created successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('status', 'Product deleted successfully!');
    }
}