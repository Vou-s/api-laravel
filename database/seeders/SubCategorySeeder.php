<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Elektronik' => ['HP', 'Laptop', 'Case'],
            'Fashion'   => ['Baju', 'Tas', 'Sepatu'],
            'Peralatan' => ['Alat Rumah Tangga', 'Perkakas'],
            'Lainnya'   => [],
        ];

        foreach ($categories as $catName => $subs) {
            // Cek kategori, insert kalau belum ada
            $category = DB::table('categories')->where('name', $catName)->first();

            if (!$category) {
                $categoryId = DB::table('categories')->insertGetId([
                    'name'       => $catName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $categoryId = $category->id;
            }

            // Tambahkan subkategori jika belum ada
            foreach ($subs as $subName) {
                $exists = DB::table('subcategories')
                    ->where('category_id', $categoryId)
                    ->where('name', $subName)
                    ->exists();

                if (!$exists) {
                    DB::table('subcategories')->insert([
                        'category_id' => $categoryId,
                        'name'        => $subName,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }
            }
        }
    }
}
