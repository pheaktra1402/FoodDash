<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cartItems = session()->get('cart', []);

        $totalAmount = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('checkout.index', compact('user', 'cartItems', 'totalAmount'));
    }

   public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'payment_method' => 'required',
        ]);

        $cartItems = session()->get('cart', []);

        $totalAmount = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Save Order to Database as Pending
        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => auth()->user()->name ?? 'Guest',
            'total_price' => $totalAmount,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // ==========================================
        // 📌 បន្ថែម Loop នេះដើម្បី Insert ចូល order_items
        // ==========================================
     foreach ($cartItems as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,    
                'price'      => $item['price'],
                'quantity'   => $item['quantity'],
            ]);
        }

        // Clear Cart
        session()->forget('cart');

        // Redirect based on payment method
        if ($request->payment_method === 'QR Code') {
            return redirect()->route('payment.qr', ['order' => $order->id]);
        }

        return redirect()->route('orders.success', ['id' => $order->id]);
    }
}