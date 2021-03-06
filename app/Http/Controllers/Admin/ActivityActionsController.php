<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ActivityServiceInterface;
use Illuminate\Support\Facades\DB;
use Log;

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
     *
     * @param $activityId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setStatus($activityId, $status)
    {
        try{
            DB::beginTransaction();
            $return = $this->activityService->setStatus($activityId, $status);
            if($return->status === config('status.status.OK')){
                DB::commit();
                \Alert::success(trans('backpack::activity.activity_status_updated_successfully'))->flash();
                return redirect('admin/activity');
            }
            DB::Rollback();
            \Alert::error(trans('backpack::activity.activitiy_status_not_allowed_to_change'))->flash();
            return redirect('admin/activity');
        } catch (Exception $e) {
            \Alert::error(trans('backpack::activity.activity_status_error_to_update'))->flash();
            DB::rollBack();
            return redirect('admin/activity');
        }
    }
}
