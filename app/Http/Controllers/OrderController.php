<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Midtrans\Snap;
use Midtrans\Config;

class OrderController extends Controller
{
    // Menampilkan semua order milik user
    public function userOrders()
    {
        return response()->json(
            Order::where('user_id', auth()->id())->with('product')->get()
        );
    }

    // Membuat order baru & generate pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'customer.name' => 'required|string',
            'customer.email' => 'required|email',
        ]);

        $orders = [];
        $itemDetails = [];
        $grossAmount = 0;

        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);

            $order = Order::create([
                'user_id'       => auth()->id(),
                'product_id'    => $product->id,
                'quantity'      => $item['quantity'], // ✅ pakai item, bukan $request->quantity
                'total'         => $product->price * $item['quantity'],
                'payment_status' => 'pending',
            ]);

            $orders[] = $order;

            // Tambahkan ke item_details untuk Midtrans
            $itemDetails[] = [
                'id'       => $product->id,
                'price'    => (int) $product->price,     // ✅ harus integer
                'quantity' => (int) $item['quantity'],   // ✅ harus integer
                'name'     => $product->name,
            ];

            $grossAmount += $product->price * $item['quantity'];
        }

        // Buat Snap Token untuk pembayaran
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),   // ✅ order_id unik untuk semua item
                'gross_amount' => (int) $grossAmount,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => auth()->user()->name ?? $request->customer['name'],
                'email'      => auth()->user()->email ?? $request->customer['email'],
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'orders' => $orders,
            'snap_token' => $snapToken,
        ]);
    }
}
