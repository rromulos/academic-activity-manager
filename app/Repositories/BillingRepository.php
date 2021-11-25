<?php

namespace App\Repositories;

use App\Models\Billing;
use App\Repositories\Interfaces\BillingRepositoryInterface;

class BillingRepository extends AbstractBaseRepository implements BillingRepositoryInterface
{
    public function __construct(Billing $model)
    {
        parent::__construct($model);
    }

    public function getBilingByActivityId($activityId)
    {
        return \App\Models\Billing::where('activity_id','=',$activityId)->first();
    }
}
