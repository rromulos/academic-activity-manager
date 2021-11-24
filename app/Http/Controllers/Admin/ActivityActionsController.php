<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ActivityServiceInterface;
use Log;
use Illuminate\Support\Facades\DB;

class ActivityActionsController extends Controller {

    private $activityService;

    /**
     * ActivityActionsController constructor.
     * @param ActivityServiceInterface $activityService
     */
    public function __construct(ActivityServiceInterface $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * Invoke service to update the activity status
     * @param $id
     */
    public function setStatusInProgress($activityId)
    {
        try{
            DB::beginTransaction();
            $return = $this->activityService->setStatus($activityId, config('status.activityStatus.IN_PROGRESS'));
            if($return->status === config('status.status.OK')){
                DB::commit();
                \Alert::error(trans('backpack::activity.activity_status_updated_successfully'))->flash();
                return;
            }
        } catch (Exception $e) {
            \Alert::error(trans('backpack::activity.activity_status_error_to_update'))->flash();
            DB::rollBack();
            return;
        }
    }
}
