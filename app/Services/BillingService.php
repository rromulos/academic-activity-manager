<?php

namespace App\Services;

use App\Repositories\Interfaces\BillingRepositoryInterface;
use App\Services\Interfaces\BillingServiceInterface;
use Log;

class BillingService implements BillingServiceInterface {

    private $billingRepository;

    public function __construct(BillingRepositoryInterface $billingRepository)
    {
        $this->billingRepository = $billingRepository;
    }

    public function generateCharge($activityId)
    {

    }
}
