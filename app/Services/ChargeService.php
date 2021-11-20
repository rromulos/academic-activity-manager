<?php

namespace App\Services;

use App\Repositories\Interfaces\ChargeRepositoryInterface;
use App\Services\Interfaces\ChargeServiceInterface;
use Log;

class ChargeService implements ChargeServiceInterface {

    private $chargeRepository;

    public function __construct(ChargeRepositoryInterface $chargeRepository)
    {
        $this->chargeRepository = $chargeRepository;
    }

    public function generateCharge($activityId)
    {

    }
}
