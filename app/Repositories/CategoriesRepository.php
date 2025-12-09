<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Repositories\BaseRepository;

class CategoriesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'parent_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Categories::class;
    }
}
