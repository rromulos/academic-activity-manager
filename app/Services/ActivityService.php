<?php

namespace App\Services;

use App\Events\BillingEvent;
use App\Repositories\Interfaces\ActivityRepositoryInterface;
use App\Services\Interfaces\ActivityServiceInterface;
use App\Services\Interfaces\BillingServiceInterface;
use App\Strategy\Interfaces\StatusChangeValidator;
use App\Strategy\StatusBilling;
use App\Strategy\StatusCanceled;
use App\Strategy\StatusDelivered;
use App\Strategy\StatusFinished;
use App\Strategy\StatusInProgress;
use App\Strategy\StatusOnHold;
use App\Strategy\StatusPaid;
use App\Strategy\StatusWaiting;
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
    public const ACTIVITY_STATUS_NOT_ALLOWED_TO_UPDATE = 'ACTIVITY_STATUS_NOT_ALLOWED_TO_UPDATE';
    public const ACTIVITY_CANNOT_BE_BILLED_PRICE_FIELD_EMPTY = 'ACTIVITY_CANNOT_BE_BILLED_PRICE_FIELD_EMPTY';
    public const ACTIVITY_CAN_BE_BILLED = 'ACTIVITY_CAN_BE_BILLED';

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
     * @TODO too much if conditions
     */
    public function setStatus($id, $status) :stdClass
    {
        $result = new stdClass();
        $activity = $this->activityRepository->getById($id);
        $statusClass = $this->loadStatusClass($activity->status);
        Log::info(__METHOD__." trying to set the activity status to = ".$status);
        if($this->checkStatusMayBeUpdate($status, $statusClass)){
            Log::info(__METHOD__." status is valid to be updated");
            $activity->status = $status;
            if($activity->save()){
                $result->status =  config('status.status.OK');
                $result->code = self::ACTIVITY_STATUS_UPDATED;
                $result->message = trans('backpack::activity.activity_status_updated');
                $check = $this->checksActivityCanBeBilled($activity, $status);
                if($check->status === config('status.status.NOK')){
                    return $check;
                }else{
                    BillingEvent::dispatch();
                }
                return $result;
            }
            $result->status =  config('status.status.NOK');
            $result->code = self::ACTIVITY_STATUS_NOT_UPDATED;
            $result->message = trans('backpack::activity.activity_status_not_updated');
            return $result;
        }
        Log::info(__METHOD__." status IS NOT valid to be updated");
        $result->status = config('status.status.NOK');
        $result->code = self::ACTIVITY_STATUS_NOT_ALLOWED_TO_UPDATE;
        $result->message = trans('backpack::activity.activity_status_not_allowed_to_change');
        return $result;
    }

    /**
     * Load the coherent status class based on the status parameter
     *
     * @param $status
     * @return mixed
     */
    private function loadStatusClass($status) :StatusChangeValidator
    {
        $statusArray = [
            config('status.activityStatus.WAITING') => StatusWaiting::class,
            config('status.activityStatus.IN_PROGRESS') => StatusInProgress::class,
            config('status.activityStatus.ON_HOLD') => StatusOnHold::class,
            config('status.activityStatus.DELIVERED') => StatusDelivered::class,
            config('status.activityStatus.BILLING') => StatusBilling::class,
            config('status.activityStatus.PAID') => StatusPaid::class,
            config('status.activityStatus.FINISHED') => StatusFinished::class,
            config('status.activityStatus.CANCELED') => StatusCanceled::class
        ];
        return new $statusArray[$status];
    }

    /**
     * Checks if the status may be updated
     *
     * @param $status
     * @param StatusChangeValidator $statusCalculator
     * @return bool
     */
    private function checkStatusMayBeUpdate($status, StatusChangeValidator $statusCalculator) :bool
    {
        return $statusCalculator->checkStatusMayBeUpdated($status);
    }

    /**
     * Checks if the activity can be billed.
     *
     * @param $activity
     * @param $status
     * @return stdClass
     */
    private function checksActivityCanBeBilled($activity, $status) :stdClass
    {
        $result = new stdClass();
        if($status === config('status.activityStatus.BILLING')){
            if (!is_null($activity->price)) {
                $result->status = config('status.status.NOK');
                $result->code = self::ACTIVITY_CANNOT_BE_BILLED_PRICE_FIELD_EMPTY;
                $result->message = trans('backpack::activity.activity_cannot_be_billed_price_field_empty');
                return $result;
            }
            $result->status = config('status.status.OK');
            $result->code = self::ACTIVITY_CAN_BE_BILLED;
            return $result;
        }
    }
}
