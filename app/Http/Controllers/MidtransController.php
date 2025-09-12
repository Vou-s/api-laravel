<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // true jika sudah live
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Ambil Snap Token berdasarkan Order
     */
    public function getToken($orderId)
    {
        try {
            $order = Order::with(['user', 'items.product'])->findOrFail($orderId);

            $params = [
                'transaction_details' => [
                    'order_id'     => 'ORDER-' . $order->id,
                    'gross_amount' => (int) $order->total_amount,
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email'      => $order->user->email,
                    'phone'      => $order->user->phone ?? '0811111111',
                ],
                'item_details' => $order->items->map(function ($item) {
                    return [
                        'id'       => $item->product_id,
                        'price'    => (int)$item->price,
                        'quantity' => $item->quantity,
                        'name'     => $item->product->name,
                    ];
                })->toArray(),
            ];

            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'success' => true,
                'token'   => $snapToken
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal ambil snap token',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
