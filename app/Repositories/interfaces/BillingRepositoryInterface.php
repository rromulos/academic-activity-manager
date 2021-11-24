<?php

namespace App\Repositories\Interfaces;

interface BillingRepositoryInterface {
    public function getBilingByActivityId($activityId);
}
