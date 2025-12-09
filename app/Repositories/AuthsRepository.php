<?php

namespace App\Repositories;

use App\Models\Auths;
use App\Repositories\BaseRepository;

class AuthsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Auths::class;
    }
}
