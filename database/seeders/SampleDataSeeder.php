<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);

        // 2. Produk
        $product1 = Product::create([
            'name' => 'Laptop Gaming',
            'description' => 'Laptop high-end untuk gaming',
            'price' => 25000000,
            'stock' => 10,
        ]);

        $product2 = Product::create([
            'name' => 'Mouse Wireless',
            'description' => 'Mouse tanpa kabel',
            'price' => 250000,
            'stock' => 50,
        ]);

        // 3. Order
        $order = Order::create([
            'user_id' => $admin->id,
            'total_amount' => 25250000,
            'status' => 'pending',
        ]);

        // 4. Order Items
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product1->id,
            'quantity' => 1,
            'price' => $product1->price,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product2->id,
            'quantity' => 1,
            'price' => $product2->price,
        ]);

        // 5. Payment
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'method' => 'bank_transfer',
            'status' => 'success',
        ]);
    }
}
