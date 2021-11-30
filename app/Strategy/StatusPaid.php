<?php

namespace App\Strategy;

use App\Strategy\Interfaces\StatusCalculatorStrategyInterface;

class StatusPaid implements StatusCalculatorStrategyInterface
{

    public function checkStatusMayBeUpdated($status) :bool
    {
        return true;
    }
}
