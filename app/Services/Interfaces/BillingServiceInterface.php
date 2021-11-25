<?php

namespace App\Services\Interfaces;

interface BillingServiceInterface{
    public function generateCharge($activityId);
}
