<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        return view('checkout.index', compact('user'));
    }

    /**
     * Process the order store action.
     */
public function store(Request $request)
{
    // គណនាតម្លៃសរុបពិតប្រាកដពី session cart
    $totalPrice = 0;
    if(session('cart')) {
        foreach(session('cart') as $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }
    }

    Order::create([
        'user_id' => Auth::id(),
        'customer_name' => Auth::user()->name, // 🔴 បញ្ចូលឈ្មោះអតិថិជនកុំឱ្យចេញ NULL
        'total_price' => $totalPrice,         // 🔴 ដាក់តម្លៃសរុបពិតប្រាកដជំនួសឱ្យការហ្វុចថេរ 50.00
        'shipping_address' => $request->shipping_address,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'payment_method' => $request->payment_method,
        'status' => 'pending',
    ]);

    // លុប cart ចោលក្រោយបញ្ជាទិញរួច និងបញ្ជូនទៅកាន់ទំព័រ Success
    session()->forget('cart');
    return redirect()->route('checkout.success');
}

    /**
     * Display the success page.
     */
    public function success()
    {
        return view('checkout.success');
    }
}