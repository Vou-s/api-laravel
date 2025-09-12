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
        $order = Order::with('user')->findOrFail($orderId);

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
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'success' => true,
            'token'   => $snapToken
        ]);
    }


    /**
     * Callback dari Midtrans (notifikasi status pembayaran)
     */
    public function callback(Request $request)
    {
        $notification = new Notification();

        $orderId = $notification->order_id; // ORDER-123
        $status  = $notification->transaction_status;
        $fraud   = $notification->fraud_status;

        // ambil order_id numeric dari ORDER-123
        $orderDbId = (int) str_replace('ORDER-', '', $orderId);
        $order = Order::find($orderDbId);

        if ($status == 'capture' && $fraud == 'accept') {
            $order->status = 'paid';
        } elseif ($status == 'settlement') {
            $order->status = 'paid';
        } elseif ($status == 'pending') {
            $order->status = 'pending';
        } elseif ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
            $order->status = 'failed';
        }

        $order->save();

        return response()->json(['success' => true]);
    }
}
