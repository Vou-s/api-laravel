<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::with(['user', 'items.product', 'payment'])->get();

            return response()->json([
                'success' => true,
                'data' => $orders
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'total_amount'  => 'required|numeric|min:0',
            'status'        => [
                'nullable',
                Rule::in(['pending', 'paid', 'failed'])
            ],
        ]);

        // Default status = pending
        $data['status'] = $data['status'] ?? 'pending';

        $order = Order::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order
        ], 201);

        Log::info('Order payload:', $request->all());
    }

    public function show(Order $order)
    {
        return response()->json([
            'success' => true,
            'data' => $order->load(['user', 'items.product', 'payment'])
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'user_id'       => 'sometimes|exists:users,id',
            'total_amount'  => 'sometimes|numeric|min:0',
            'status'        => [
                'sometimes',
                Rule::in(['pending', 'paid', 'failed'])
            ],
        ]);

        $order->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
            'data' => $order
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully'
        ], 200);
    }
}
