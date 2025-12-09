<?php

namespace App\Repositories;

use App\Models\Midtrans;
use App\Repositories\BaseRepository;

class MidtransRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Midtrans::class;
    }
}
