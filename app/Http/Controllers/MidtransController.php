<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function getToken($orderId)
    {
        try {
            $order = Order::with(['user', 'items.product'])->findOrFail($orderId);

            if (!$order || (float)$order->total_amount <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Total amount tidak valid (<= 0)',
                ], 400);
            }

            $params = [
                'transaction_details' => [
                    'order_id'     => 'ORDER-' . $order->id,
                    'gross_amount' => max(100, (float) $order->total_amount), // ✅ minimal Rp100
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email'      => $order->user->email,
                    'phone'      => $order->user->phone ?? '0811111111',
                ],
                'item_details' => $order->items->map(function ($item) {
                    return [
                        'id'       => $item->product_id,
                        'price'    => max(100, (float) $item->price), // ✅ float
                        'quantity' => (int) $item->quantity,
                        'name'     => $item->product->name ?? 'Unknown',
                    ];
                })->toArray(),
            ];

            // ✅ Logging untuk debug
            Log::info('Midtrans Request Params', $params);

            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'success' => true,
                'token'   => $snapToken
            ]);
        } catch (\Exception $e) {
            Log::error("Midtrans error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal ambil snap token',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            $notification = new Notification();

            $orderId = (int) str_replace('ORDER-', '', $notification->order_id);
            $order   = Order::find($orderId);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order tidak ditemukan'
                ], 404);
            }

            switch ($notification->transaction_status) {
                case 'capture':
                case 'settlement':
                    $order->status = 'paid';
                    break;
                case 'pending':
                    $order->status = 'pending';
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $order->status = 'failed';
                    break;
            }

            $order->save();

            Log::info("Midtrans Callback Update", [
                'order_id' => $orderId,
                'status'   => $order->status
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("Midtrans Callback Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Callback gagal',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
