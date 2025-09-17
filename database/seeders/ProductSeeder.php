<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Laptop A',
                'description' => 'Laptop A dengan performa tinggi untuk kerja dan gaming.',
                'price' => 7500000,
                'stock' => 10,
                'category' => 'lepi',
                'image' => 'laptop-a.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop B',
                'description' => 'Laptop B ringan dan cocok untuk pelajar.',
                'price' => 5500000,
                'stock' => 15,
                'category' => 'lepi',
                'image' => 'laptop-b.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HP X',
                'description' => 'Smartphone dengan kamera 108MP dan baterai besar.',
                'price' => 3200000,
                'stock' => 20,
                'category' => 'hp',
                'image' => 'hp-x.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HP Y',
                'description' => 'Smartphone murah dengan fitur lengkap.',
                'price' => 2200000,
                'stock' => 25,
                'category' => 'hp',
                'image' => 'hp-y.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Charger Laptop',
                'description' => 'Charger original untuk berbagai tipe laptop.',
                'price' => 250000,
                'stock' => 50,
                'category' => 'acc',
                'image' => 'charger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mouse Wireless',
                'description' => 'Mouse wireless ergonomis dengan baterai tahan lama.',
                'price' => 150000,
                'stock' => 40,
                'category' => 'acc',
                'image' => 'mouse.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Case Merah',
                'description' => 'Case handphone warna merah, stylish dan kuat.',
                'price' => 100000,
                'stock' => 30,
                'category' => 'case',
                'image' => 'case-merah.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Case Transparan',
                'description' => 'Case bening fleksibel dan ringan.',
                'price' => 80000,
                'stock' => 35,
                'category' => 'case',
                'image' => 'case-transparan.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
