<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
    ];

    // Casting field (price jadi float biar lebih mudah dipakai di frontend)
    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
    ];

    // Relasi ke Order (satu produk bisa ada di banyak order)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
