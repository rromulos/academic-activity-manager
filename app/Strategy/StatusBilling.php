<?php

namespace App\Strategy;

use App\Strategy\Interfaces\StatusCalculatorStrategyInterface;

class StatusBilling implements StatusCalculatorStrategyInterface
{

    public function checkStatusMayBeUpdated($status) :bool
    {
        return true;
    }
}
