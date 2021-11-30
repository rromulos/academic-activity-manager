<?php

namespace App\Strategy;

use App\Strategy\Interfaces\StatusCalculatorStrategyInterface;

class StatusCanceled implements StatusCalculatorStrategyInterface
{

    public function checkStatusMayBeUpdated($status) :bool
    {
        return true;
    }
}
