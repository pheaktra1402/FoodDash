<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $data = $request->all();
        
        // Log incoming message for debugging
        Log::info('Telegram Webhook Data:', $data);

        // Check if message exists
        if (isset($data['message']['text'])) {
            $text = $data['message']['text'];

            // ABA notification usually contains amount and remark/bill number
            // Example message from ABA: "Received $5.00 from JOHN DOE. Remark: ORD-12"
            
            // Extract Order ID using Regular Expressions (Regex)
            if (preg_match('/ORD-(\d+)/i', $text, $matches)) {
                $orderId = $matches[1];

                $order = Order::find($orderId);

                if ($order && $order->payment_status !== 'paid') {
                    $order->update([
                        'payment_status' => 'paid',
                        'order_status'   => 'processing',
                    ]);

                    Log::info("Order #{$orderId} updated to PAID successfully via Telegram Webhook.");
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }
}