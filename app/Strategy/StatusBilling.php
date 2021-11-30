<?php

namespace App\Strategy;

use App\Strategy\Interfaces\StatusChangeValidator;

class StatusBilling implements StatusChangeValidator
{

    public function checkStatusMayBeUpdated($status) :bool
    {
        $validStatus = [
            config('status.activityStatus.FINISHED'),
            config('status.activityStatus.CANCELED'),
        ];
        return (in_array($status, $validStatus, true)) ? true : false;
    }
}
