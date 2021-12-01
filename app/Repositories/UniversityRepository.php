<?php

namespace App\Repositories;

use App\Models\University;
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use App\Repositories\AbstractBaseRepository;

class UniversityRepository extends AbstractBaseRepository implements UniversityRepositoryInterface
{
    public function __construct(University $model)
    {
        parent::__construct($model);
    }
}
