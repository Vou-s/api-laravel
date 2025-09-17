<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama produk
            $table->text('description')->nullable(); // deskripsi produk
            $table->decimal('price', 12, 2); // harga
            $table->integer('stock'); // stok barang
            $table->enum('category', ['lepi', 'hp', 'acc', 'case']); // kategori
            $table->string('image')->nullable(); // gambar produk
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
