<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index()
    {
        // Fetch products from database
        $products = Product::where('status', 1)->latest()->paginate();

        return view('products.index', compact('products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'selling_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'product_code' => 'PRD-' . rand(1000, 9999), // 👈 Generates product_code automatically!
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'selling_price' => $request->selling_price,
            'image' => $imagePath,
        ]);


        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('.products.show', compact('product'));
    }
    
}