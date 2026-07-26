<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
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
    // Process the checkout and save order to database
public function checkout()
{
    $cart = session()->get('cart');

    if(!$cart || count($cart) == 0) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
    }

    // Calculate total
    $totalPrice = 0;
    foreach($cart as $details) {
        $totalPrice += $details['price'] * $details['quantity'];
    }

    // Create the Order record
    $order = Order::create([
        'user_id'       => Auth::id(), // null if guest, or authenticated user ID
        'customer_name' => Auth::user()->name ?? 'Guest Buyer',
        'total_price'   => $totalPrice,
        'status'        => 'pending'
    ]);

    // Save individual order items
    foreach($cart as $id => $details) {
        // Check if you have an OrderItem model/table, or save directly if structured differently
        \DB::table('order_items')->insert([
            'order_id'   => $order->id,
            'product_id' => $id,
            'price'      => $details['price'],
            'quantity'   => $details['quantity'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Clear the cart session
    session()->forget('cart');

    return redirect()->route('products.index')->with('success', 'Order placed successfully! Thank you for buying.');
}
}