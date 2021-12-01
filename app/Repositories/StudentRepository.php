<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\AbstractBaseRepository;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository extends AbstractBaseRepository implements StudentRepositoryInterface
{
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }
}
