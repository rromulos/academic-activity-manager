<?php

namespace App\Strategy;

use App\Strategy\Interfaces\StatusChangeValidator;

class StatusDelivered implements StatusChangeValidator
{

    public function checkStatusMayBeUpdated($status) :bool
    {
        $validStatus = [
            config('status.activityStatus.WAITING'),
            config('status.activityStatus.ON_HOLD'),
            config('status.activityStatus.IN_PROGRESS'),
            config('status.activityStatus.CANCELED'),
        ];
        return (in_array($status, $validStatus, true)) ? true : false;
    }
}
