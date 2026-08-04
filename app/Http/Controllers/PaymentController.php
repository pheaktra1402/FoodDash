<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showQrPage($orderId)
    {
        $order = Order::findOrFail($orderId);

        // If already paid/completed, send directly to success page
        if ($order->status === 'completed' || $order->status === 'paid') {
            return redirect()->route('orders.success', $order->id);
        }

        return view('checkout.pay_qr', compact('order'));
    }

    public function checkStatus($orderId)
    {
        $order = Order::findOrFail($orderId);

        return response()->json([
            'status' => $order->status,
        ]);
    }
    public function confirmPayment($id)
{
    $order = Order::findOrFail($id);
    // កូដសម្រាប់កែប្រែ status ទៅជា processing ឬ completed
    $order->status = 'processing';
    $order->save();

    return redirect()->back()->with('success', 'Payment confirmed successfully!');
}
}