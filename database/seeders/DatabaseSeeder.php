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
        // $this->call(SampleDataSeeder::class);
           $this->call(ProductSeeder::class);
    }
}
