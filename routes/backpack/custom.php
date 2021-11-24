<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::get('activity/setStatusInProgress/{activityId}', ['as' => 'setStatusInProgress', 'uses' => 'ActivityActionsController@setStatusInProgress']);


    Route::crud('university', 'UniversityCrudController');
    Route::crud('student', 'StudentCrudController');
    Route::crud('subject', 'SubjectCrudController');
    Route::crud('activity', 'ActivityCrudController');
    Route::crud('billing', 'BillingCrudController');
    Route::crud('payment', 'PaymentCrudController');
}); // this should be the absolute last line of this file
