<?php

namespace App\Strategy\Interfaces;

interface StatusCalculatorStrategyInterface
{
    public function checkStatusMayBeUpdated($status);
}
