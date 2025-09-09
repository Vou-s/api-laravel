<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name'        => 'Laptop Gaming',
            'price'       => 15000000,
            'stock'       => 10,
            'description' => 'Laptop gaming dengan spesifikasi tinggi',
        ]);

        Product::create([
            'name'        => 'Smartphone 5G',
            'price'       => 7000000,
            'stock'       => 25,
            'description' => 'Smartphone terbaru dengan koneksi 5G',
        ]);

        Product::create([
            'name'        => 'Headset Bluetooth',
            'price'       => 500000,
            'stock'       => 50,
            'description' => 'Headset wireless dengan kualitas suara premium',
        ]);
    }
}
