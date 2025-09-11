<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with(['user', 'items.product', 'payment'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric',
            'status' => 'string',
        ]);

        return Order::create($data);
    }

    public function show(Order $order)
    {
        return $order->load(['user', 'items.product', 'payment']);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'user_id' => 'exists:users,id',
            'total_amount' => 'numeric',
            'status' => 'string',
        ]);

        $order->update($data);
        return $order;
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->noContent();
    }
}
