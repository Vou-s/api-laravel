<?php

namespace App\Repositories;

use App\Models\SubCategory;
use App\Repositories\BaseRepository;

class SubCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'category_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SubCategory::class;
    }
}
