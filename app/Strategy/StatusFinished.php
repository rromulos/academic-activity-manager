<?php

namespace App\Strategy;

use App\Strategy\Interfaces\StatusChangeValidator;

class StatusFinished implements StatusChangeValidator
{

    public function checkStatusMayBeUpdated($status) :bool
    {
        $validStatus = [
            config('status.activityStatus.PAID'),
        ];
        return (in_array($status, $validStatus, true)) ? true : false;
    }
}
