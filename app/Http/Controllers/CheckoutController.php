<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     * Accessible only to authenticated users (via middleware).
     */
    public function index(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch cart items, products, or pricing logic here
        // Example: $cartItems = $user->cartItems;

        return view('checkout.index', compact('user'));
    }

    /**
     * Display the order success page.
     */
    public function success()
    {
        return view('checkout.success');
    }
    public function store(Request $request)
{
    // 1. Validate the incoming request data
    $validated = $request->validate([
        'shipping_address' => ['required', 'string', 'max:255'],
        'payment_method'   => ['required', 'string'],
        // Include validation for total if it comes from the request, 
        // or calculate it from the user's cart items:
        // 'total_price' => ['required', 'numeric'],
    ]);

    $user = Auth::user();

    // Example: Calculate total from cart or retrieve it from request
    $totalPrice = 50.00; // Replace this with your actual cart calculation logic

    try {
        // 2. Create the order with 'total_price' included
        $order = $user->orders()->create([
            'shipping_address' => $validated['shipping_address'],
            'total_price'      => $totalPrice, // <--- Added this line
            'status'           => 'pending',
        ]);

        return redirect()->route('checkout.success')->with('success', 'Your order has been placed successfully!');

    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Payment failed. Please try again.']);
    }
}
}