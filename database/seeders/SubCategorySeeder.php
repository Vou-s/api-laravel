<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $subcategories = [
            ['name' => 'Mobile Phones', 'category' => 'Electronics'],
            ['name' => 'Laptops', 'category' => 'Electronics'],
            ['name' => 'Men\'s Clothing', 'category' => 'Clothing'],
            ['name' => 'Women\'s Clothing', 'category' => 'Clothing'],
            ['name' => 'Fiction', 'category' => 'Books'],
            ['name' => 'Non-Fiction', 'category' => 'Books'],
        ];

        foreach ($subcategories as $sub) {
            $category = Category::where('name', $sub['category'])->first();
            if ($category) {
                Subcategory::create([
                    'name' => $sub['name'],
                    'category_id' => $category->id
                ]);
            }
        }
    }
}
