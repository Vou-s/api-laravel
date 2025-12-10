<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Products;
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
