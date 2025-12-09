<?php

namespace App\Repositories;

use App\Models\Order_Items;
use App\Repositories\BaseRepository;

class Order_ItemsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Order_Items::class;
    }
}
