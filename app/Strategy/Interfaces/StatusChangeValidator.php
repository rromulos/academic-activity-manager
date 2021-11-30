<?php

namespace App\Strategy\Interfaces;

interface StatusChangeValidator
{
    public function checkStatusMayBeUpdated($status);
}
