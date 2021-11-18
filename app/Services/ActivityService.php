<?php

namespace App\Services;

use App\Services\Interfaces\ActivityRepositoryInterface;
use App\Services\Interfaces\ActivityServiceInterface;
use App\Services\Interfaces\ChargeServiceInterface;
use Illuminate\Support\Facades\Log;
use stdClass;

class ActivityService implements ActivityServiceInterface
{

    private $chargeService;
    private $activityRepository;

    public const ACTIVITY_CANNOT_BE_FINISHED_INVALID_STATUS = 'ACTIVITY_CANNOT_BE_FINISHED_INVALID_STATUS';
    public const ACTIVITY_FINISHED = 'ACTIVITY_FINISHED';

    public function __construct(ChargeServiceInterface $chargeService,
                                ActivityRepositoryInterface $activityRepository)
    {
        $this->chargeService = $chargeService;
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
            $this->chargeService->generateCharge($id);
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
}