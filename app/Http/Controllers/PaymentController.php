<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MidtransService;

class PaymentController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    public function checkout(Request $request)
    {
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        $transaction = $this->midtrans->createTransaction($params);

        return response()->json([
            'token' => $transaction->token,
            'redirect_url' => $transaction->redirect_url,
        ]);
    }

    public function notification(Request $request)
    {
        // Handle webhook notification dari Midtrans
        return response()->json(['status' => 'ok']);
    }
}
