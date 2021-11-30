<?php

namespace App\Strategy;

use App\Strategy\Interfaces\StatusChangeValidator;

class StatusPaid implements StatusChangeValidator
{

    public function checkStatusMayBeUpdated($status) :bool
    {
        $validStatus = [
            config('status.activityStatus.BILLING'),
        ];
        return (in_array($status, $validStatus, true)) ? true : false;
    }
}
