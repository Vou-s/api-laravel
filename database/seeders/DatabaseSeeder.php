<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 user random + 1 user test
        User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Buat 20 produk random
        Product::factory(20)->create();

        // Buat 5 order dengan item + payment
        Order::factory(5)->create()->each(function ($order) {
            $items = OrderItem::factory(3)->create([
                'order_id' => $order->id,
            ]);

            // hitung total harga dari item
            $order->total = $items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $order->status = 'pending';
            $order->save();

            // buat payment untuk order ini
            Payment::factory()->create([
                'order_id' => $order->id,
                'amount' => $order->total,
                'status' => 'paid',
                'payment_method' => 'bank_transfer',
            ]);
        });
    }
}
