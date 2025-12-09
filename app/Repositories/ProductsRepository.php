<?php

namespace App\Repositories;

use App\Models\Products;
use App\Repositories\BaseRepository;

class ProductsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'description',
        'price',
        'category_id',
        'subcategory_id',
        'stock'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Products::class;
    }
}
