<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\subcategory;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // $this->call(SampleDataSeeder::class);
        // $this->call(ProductSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
    }
}
