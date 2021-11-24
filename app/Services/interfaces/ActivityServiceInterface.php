<?php

namespace App\Services\Interfaces;

interface ActivityServiceInterface {
    public function finish($id);
    public function setStatus($id, $status);
}
