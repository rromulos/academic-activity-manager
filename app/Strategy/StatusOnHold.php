<?php

namespace App\Strategy;

use Log;
use App\Strategy\Interfaces\StatusChangeValidator;

class StatusOnHold implements StatusChangeValidator
{

    public function checkStatusMayBeUpdated($status) : bool
    {
        $validStatus = [
            config('status.activityStatus.WAITING'),
            config('status.activityStatus.IN_PROGRESS'),
            config('status.activityStatus.DELIVERED'),
        ];
        return (in_array($status, $validStatus, true)) ? true : false;
    }
}
