<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ActivityRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ActivityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ActivityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Activity::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/activity');
        CRUD::setEntityNameStrings('activity', 'activities');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name'  => 'id',
            'label' => trans('backpack::crud.Id'),
            'type'  => 'text',
            'priority' => 1,
        ]);
        CRUD::addColumn([
            'label' => trans('backpack::crud.Student'),
            'type' => 'select',
            'name' => 'student_id',
            'entity' => 'Student',
            'attribute' => 'name',
            'priority' => 2,
        ]);
        CRUD::addColumn([
            'label' => trans('backpack::crud.Subject'),
            'type' => 'select',
            'name' => 'subject_id',
            'entity' => 'Subject',
            'attribute' => 'name',
            'priority' => 3,
        ]);
        CRUD::addColumn([
            'name'  => 'type',
            'label' => trans('backpack::crud.Type'),
            'type'  => 'text',
            'priority' => 4,
        ]);
        CRUD::addColumn([
            'name' => 'delivery_date',
            'label' => trans('backpack::crud.Subject'),
            "type" => "date",
            'format' => 'l',
            'priority' => 5
        ]);
        CRUD::addColumn([
            'name'  => 'observation',
            'label' => trans('backpack::crud.Observation'),
            'type'  => 'text',
            'priority' => 6,
        ]);
        CRUD::addColumn([
            'name' => 'price',
            'label' => trans('backpack::crud.Price'),
            'type' => 'text',
            'prefix' => 'R$',
            'priority' => 7
        ]);
        CRUD::addColumn([
            'name'  => 'status',
            'label' => trans('backpack::crud.Status'),
            'type'  => 'text',
            'priority' => 8,
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ActivityRequest::class);



        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
