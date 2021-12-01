<?php

namespace App\Services;

use App\Repositories\Interfaces\BillingRepositoryInterface;
use App\Services\Interfaces\BillingServiceInterface;

class BillingService implements BillingServiceInterface {

    private $billingRepository;

    public function __construct(BillingRepositoryInterface $billingRepository)
    {
        $this->billingRepository = $billingRepository;
    }

    public function generateBilling($activityId)
    {
        // TODO: Implement generateBilling() method.
    }
}
