<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'user_id' => User::factory(), // otomatis buat user baru kalau belum ada
            'total' => 0, // nanti diisi setelah order_items dibuat
            'status' => 'pending',
            'payment_method' => null,
            'midtrans_order_id' => null,
            'midtrans_transaction_id' => null,
            'payment_response' => null,
        ];
    }
}
