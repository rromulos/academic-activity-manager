<?php

namespace App\Services;

use App\Repositories\Interfaces\ActivityRepositoryInterface;
use App\Services\Interfaces\ActivityServiceInterface;
use App\Services\Interfaces\BillingServiceInterface;
use App\Strategy\Interfaces\StatusCalculatorStrategyInterface;
use App\Strategy\StatusInProgress;
use App\Strategy\StatusOnHold;
use Illuminate\Support\Facades\Log;
use stdClass;

class ActivityService implements ActivityServiceInterface
{

    private $billingService;
    private $activityRepository;

    public const ACTIVITY_CANNOT_BE_FINISHED_INVALID_STATUS = 'ACTIVITY_CANNOT_BE_FINISHED_INVALID_STATUS';
    public const ACTIVITY_FINISHED = 'ACTIVITY_FINISHED';
    public const ACTIVITY_STATUS_UPDATED = 'ACTIVITY_STATUS_UPDATED';
    public const ACTIVITY_STATUS_NOT_UPDATED = 'ACTIVITY_STATUS_NOT_UPDATED';

    public function __construct(BillingServiceInterface $billingService,
                                ActivityRepositoryInterface $activityRepository)
    {
        $this->billingService = $billingService;
        $this->activityRepository = $activityRepository;
    }

    /**
     * finish an activity
     *
     * @param $id
     * @return stdClass
     */
    public function finish($id) :stdClass
    {
        Log::info(__METHOD__." finishing activity id = ".$id);
        $result = new stdClass();
        if($this->checkToFinish($id)){
            $activity = $this->activityRepository->getById($id);
            $activity->status = config('status.activityStatus.FINISHED');
            $activity->save();
            $this->billingService->generateCharge($id);
            $result->status = config('status.status.OK');
            $result->code = self::ACTIVITY_FINISHED;
            Log::info(__METHOD__." activity finished");
            return $result;
        }
        Log::info(__METHOD__." activity not finished");
        $result->status = config('status.status.NOK');
        $result->code = self::ACTIVITY_CANNOT_BE_FINISHED_INVALID_STATUS;
        return $result;
    }

    /**
     * Check if the activity can be finished
     *
     * @param $id
     * @return bool
     */
    private function checkToFinish($id): bool
    {
        Log::debug(__METHOD__." Checking if the activity id = ".$id." can be finished");
        $activity = $this->activityRepository->getById($id);
        if ($activity->status === config('status.activityStatus.PAID')){
            Log::debug(__METHOD__." returning true");
            return true;
        }
        Log::debug(__METHOD__." returning false");
        return false;
    }

    /**
     * Set activity Status
     *
     * @param $id
     * @param $status
     * @return stdClass
     */
    public function setStatus($id, $status) :stdClass
    {
        $result = new stdClass();
        $statusClass = $this->loadStatusClass($status);
        $this->checkStatusMayBeUpdate($status, $statusClass);
        $activity = $this->activityRepository->getById($id);
        $activity->status = $status;
        if($activity->save()){
            $result->status =  config('status.status.OK');
            $result->code = self::ACTIVITY_STATUS_UPDATED;
            $result->message = trans('backpack::activity.activity_status_updated');
            return $result;
        }
        $result->status =  config('status.status.NOK');
        $result->code = self::ACTIVITY_STATUS_NOT_UPDATED;
        $result->message = trans('backpack::activity.activity_status_not_updated');
        return $result;
    }

    /**
     * Load the coherent status class based on the status parameter
     * @param $status
     * @return mixed
     */
    private function loadStatusClass($status)
    {
        $statusArray = [
            config('status.activityStatus.IN_PROGRESS') => StatusInProgress::class,
            config('status.activityStatus.ON_HOLD') => StatusOnHold::class,
        ];
        return new $statusArray[$status];
    }

    /**
     * Checks if the status may be updated
     *
     * @param $status
     * @param StatusCalculatorStrategyInterface $statusCalculator
     * @return bool
     */
    private function checkStatusMayBeUpdate($status, StatusCalculatorStrategyInterface $statusCalculator) :bool
    {
        return $statusCalculator->checkStatusMayBeUpdated($status);
    }
}
