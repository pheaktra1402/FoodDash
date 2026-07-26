<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Display the cart page
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Add product to cart
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // If product already exists in cart, increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('quantity', 1);
        } else {
            // Otherwise, add new product item to cart array
            $cart[$id] = [
                "name" => $product->name ?? $product->title ?? 'Product',
                "price" => $product->price ?? $product->selling_price ?? 0,
                "quantity" => $request->input('quantity', 1),
                "image" => $product->image ?? null
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // Update cart item quantities
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            
            if ($request->quantity > 0) {
                $cart[$request->id]["quantity"] = $request->quantity;
            } else {
                unset($cart[$request->id]);
            }

            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully!');
        }
    }

    // Remove single item from cart
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully!');
        }
    }
}