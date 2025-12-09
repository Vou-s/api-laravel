<?php

namespace App\Repositories;

use App\Models\SubCategories;
use App\Repositories\BaseRepository;

class SubCategoriesRepository extends BaseRepository
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
        return SubCategories::class;
    }
}
