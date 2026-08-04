<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        // Fetch orders and pass them to the view
        $orders = Order::latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Confirm payment from Admin panel after checking bank app
     */
    public function confirmPayment($id)
    {
        $order = Order::findOrFail($id);

        // 1. Mark as paid and completed
        $order->payment_status = 'paid';
        $order->status = 'completed';
        $order->save();

        // 2. Send Telegram notification showing PAID status
        if (!$order->telegram_notified) {
            $this->sendTelegramNotification($order);

            // Mark so duplicate messages aren't sent
            $order->update(['telegram_notified' => true]);
        }

        return redirect()->back()->with('success', 'Payment confirmed and Telegram alert sent!');
    }

    public function checkPaymentStatus($id)
    {
        $order = Order::findOrFail($id);

        return response()->json([
            'status' => $order->payment_status ?? $order->status,
        ]);
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "name"     => $product->name ?? $product->title,
                "price"    => $product->price ?? $product->selling_price,
                "quantity" => $quantity,
                "image"    => $product->image ?? null
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function orderSuccess($id)
    {
        $order = Order::findOrFail($id);

        // Option A: If you do NOT want Telegram sent when customer finishes checkout,
        // comment out or remove this block:
        /*
        if (!$order->telegram_notified) {
            $this->sendTelegramNotification($order);
            $order->update(['telegram_notified' => true]);
        }
        */

        return view('admin.orders.success', compact('order'));
    }

    public function submitPaymentProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        $order = Order::findOrFail($id);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('receipts', 'public');
            $order->update(['payment_proof' => $path]);
            
            // Send Telegram notification with attached image receipt
            $this->sendTelegramWithReceipt($order, storage_path('app/public/' . $path));
        }

        return redirect()->route('orders.success', ['id' => $order->id]);
    }

    private function sendTelegramWithReceipt($order, $imageFilePath)
    {
        $botToken = config('services.telegram.bot_token');
        $chatId   = config('services.telegram.chat_id');

        if (!$botToken || !$chatId) return;

        $caption = "🧾 *NEW PAYMENT PROOF SUBMITTED!*\n\n" .
                   "🆔 *Order ID:* #{$order->id}\n" .
                   "👤 *Customer:* {$order->customer_name}\n" .
                   "💵 *Total Amount:* \${$order->total_price}\n" .
                   "💳 *Payment Method:* {$order->payment_method}\n" .
                   "📍 *Address:* {$order->shipping_address}\n\n" .
                   "⚠️ *Action Needed:* Please check the attached receipt and verify with your bank app before shipping!";

        try {
            Http::withOptions(['verify' => false])
                ->attach('photo', file_get_contents($imageFilePath), basename($imageFilePath))
                ->post("https://api.telegram.org/bot{$botToken}/sendPhoto", [
                    'chat_id'    => $chatId,
                    'caption'    => $caption,
                    'parse_mode' => 'Markdown',
                ]);
        } catch (\Exception $e) {
            Log::error('Telegram Error: ' . $e->getMessage());
        }
    }

    private function sendTelegramNotification($order)
    {
        $botToken = config('services.telegram.bot_token');
        $chatId   = config('services.telegram.chat_id');

        if (!$botToken || !$chatId) return;

        $isPaid = ($order->status === 'completed' || $order->payment_status === 'paid');

        if ($isPaid) {
            $header = "✅ *NEW PAID ORDER! (Verified)*\n*Payment Status: PAID*";
            $action = "🚀 *Action:* Payment has been verified. Ready to ship!";
        } else {
            $header = "⚠️ *NEW ORDER SUBMITTED (Check Bank App!)*\n*Payment Status: UNVERIFIED / PENDING*";
            $action = "👉 *Action Required:* Please verify your Bakong/ABA app to confirm \${$order->total_price} received before shipping!";
        }

        $message = "{$header}\n\n" .
                   "🆔 *Order ID:* #{$order->id}\n" .
                   "👤 *Customer:* {$order->customer_name}\n" .
                   "💵 *Total Amount:* \${$order->total_price}\n" .
                   "💳 *Payment Method:* {$order->payment_method}\n" .
                   "📍 *Address:* {$order->shipping_address}\n\n" .
                   "{$action}";

        try {
            Http::withOptions(['verify' => false])->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id'    => $chatId,
                'text'       => $message,
                'parse_mode' => 'Markdown',
            ]);
        } catch (\Exception $e) {
            Log::error('Telegram Error: ' . $e->getMessage());
        }
    }
}