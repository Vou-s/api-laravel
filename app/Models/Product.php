<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
    ];
    protected $casts = [];

    protected $guarded = [];


    public static array $rules = [];
}
