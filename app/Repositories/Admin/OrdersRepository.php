<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Orders;
use App\Repositories\BaseRepository;

class OrdersRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'total_amount',
        'status',
        'payment_method'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Orders::class;
    }
}
