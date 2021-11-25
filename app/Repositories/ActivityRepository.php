<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Repositories\Interfaces\ActivityRepositoryInterface;

class ActivityRepository extends AbstractBaseRepository implements ActivityRepositoryInterface {

    public function __construct(Activity $model)
    {
        parent::__construct($model);
    }
}
