<?php

namespace App\Repositories;

use App\Models\Users;
use App\Repositories\BaseRepository;

class UsersRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'email',
        'password'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Users::class;
    }
}
