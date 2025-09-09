<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function __construct()
    {
        // Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // GET /orders
    public function index()
    {
        return response()->json(Order::with('product')->get());
    }

    // GET /orders/{id}
    public function show($id)
    {
        $order = Order::with('product')->find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return response()->json($order);
    }

    // POST /orders → Create + Midtrans Snap Token
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'customer.name' => 'required|string',
            'customer.email' => 'required|email',
        ]);

        $total = 0;
        $orderItems = [];

        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $subtotal = $product->price * $item['quantity'];
            $total += $subtotal;

            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'subtotal' => $subtotal,
            ];
        }

        $order = Order::create([
            'user_id' => auth()->id() ?? null,
            'total' => $total,
            'payment_status' => 'pending',
        ]);

        // Simpan items
        foreach ($orderItems as $oi) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $oi['product_id'],
                'quantity' => $oi['quantity'],
                'price' => $oi['price'],
                'subtotal' => $oi['subtotal'],
            ]);
        }

        // Midtrans Snap Token
        $params = [
            'transaction_details' => [
                'order_id'     => $order->id,
                'gross_amount' => $total,
            ],
            'item_details' => array_map(function ($oi) {
                return [
                    'id' => $oi['product_id'],
                    'price' => $oi['price'],
                    'quantity' => $oi['quantity'],
                    'name' => Product::find($oi['product_id'])->name,
                ];
            }, $orderItems),
            'customer_details' => [
                'first_name' => $request->customer['name'],
                'email'      => $request->customer['email'],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'order' => $order,
            'snap_token' => $snapToken,
        ]);
    }

    // PUT /orders/{id}
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $request->validate([
            'quantity' => 'sometimes|integer|min:1',
            'payment_status' => 'sometimes|string|in:pending,paid,cancelled',
        ]);

        if ($request->has('quantity')) {
            $order->quantity = $request->quantity;
            $order->total = $order->product->price * $request->quantity;
        }

        if ($request->has('payment_status')) {
            $order->payment_status = $request->payment_status;
        }

        $order->save();

        return response()->json($order);
    }

    // DELETE /orders/{id}
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);
    }
}
