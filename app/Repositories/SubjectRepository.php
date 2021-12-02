<?php

namespace App\Repositories;

use App\Models\Subject;
use App\Repositories\Interfaces\SubjectRepositoryInterface;

class SubjectRepository extends AbstractBaseRepository implements SubjectRepositoryInterface
{
    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }
}
