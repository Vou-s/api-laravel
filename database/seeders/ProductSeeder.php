<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Subcategory;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'iPhone 15', 'description' => 'Latest Apple iPhone', 'price' => 1200, 'subcategory' => 'Mobile Phones', 'stock' => 10],
            ['name' => 'MacBook Pro', 'description' => 'Apple laptop', 'price' => 2500, 'subcategory' => 'Laptops', 'stock' => 5],
            ['name' => 'T-Shirt', 'description' => 'Cotton t-shirt', 'price' => 25, 'subcategory' => 'Men\'s Clothing', 'stock' => 50],
            ['name' => 'Dress', 'description' => 'Summer dress', 'price' => 45, 'subcategory' => 'Women\'s Clothing', 'stock' => 30],
            ['name' => 'The Great Gatsby', 'description' => 'Classic novel', 'price' => 15, 'subcategory' => 'Fiction', 'stock' => 20],
        ];

        foreach ($products as $p) {
            $subcategory = Subcategory::where('name', $p['subcategory'])->first();
            if ($subcategory) {
                Product::create([
                    'name' => $p['name'],
                    'description' => $p['description'],
                    'price' => $p['price'],
                    'subcategory_id' => $subcategory->id,
                    'category_id' => $subcategory->category_id,
                    'stock' => $p['stock'],
                ]);
            }
        }
    }
}
