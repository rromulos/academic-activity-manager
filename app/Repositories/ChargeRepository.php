<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ChargeRepositoryInterface;

class ChargeRepository extends AbstractBaseRepository implements ChargeRepositoryInterface
{
    public function getChargeByActivityId($activityId)
    {
        return \App\Models\Charge::where('activity_id','=',$activityId)->first();
    }
}
