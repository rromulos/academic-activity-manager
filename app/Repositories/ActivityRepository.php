<?php

namespace App\Repositories;

use App\Models\Activity;

class ActivityRepository extends AbstractBaseRepository implements ActivityRepositoryInterface {

    public function __construct(Activity $model)
    {
        parent::__construct($model);
    }
}
