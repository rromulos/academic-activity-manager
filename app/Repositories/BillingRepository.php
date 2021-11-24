<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BillingRepositoryInterface;

class BillingRepository extends AbstractBaseRepository implements BillingRepositoryInterface
{
    public function getBilingByActivityId($activityId)
    {
        return \App\Models\Billing::where('activity_id','=',$activityId)->first();
    }
}
