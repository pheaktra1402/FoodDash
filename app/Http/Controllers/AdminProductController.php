<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
class AdminProductController extends Controller
{
    // Admin Product Dashboard
    public function dashboard(){
        $products = Product::latest() ->get();
        return view('admin.dashboard', compact('products'));
    }
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // 1. Show the form to create a new product (Fixes your error!)
   public function create()
{
    $categories = Category::all();
    return view('admin.products.create', compact('categories')); 
}

    // 2. Save the new product to the database
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|unique:products,product_code',
            'product_name'  => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'description'   => 'nullable|string',
            'selling_price' => 'required|numeric',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
           'product_code' => $request->product_code,
            'product_name'  => $request->product_name,
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'selling_price' => $request->selling_price,
            'image'         => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }


    // Delete Product
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('status', 'Product deleted!');
    }
     // Show the edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product record
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'required|string|max:255',
            'selling_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Update image if a new file was uploaded
        if ($request->hasFile('image')) {
            // Delete old image from storage if it exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update database fields
        $product->product_name = $request->product_name;
        $product->selling_price = $request->selling_price;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

}