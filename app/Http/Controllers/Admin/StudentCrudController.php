<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('student', 'students');
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
            'name'  => 'name',
            'label' => trans('backpack::crud.Name'),
            'type'  => 'text'
        ]);
        CRUD::addColumn([
            'label' => trans('backpack::crud.University'),
            'type' => 'select',
            'name' => 'university_id',
            'entity' => 'University',
            'attribute' => 'name',
            'priority' => 2,
        ]);
        CRUD::addColumn([
            'name'  => 'phone',
            'label' => trans('backpack::crud.Phone'),
            'type'  => 'text'
        ]);
        CRUD::addColumn([
            'name'  => 'email',
            'label' => trans('backpack::crud.Email'),
            'type'  => 'text'
        ]);
        CRUD::addColumn([
            'name'  => 'status',
            'label' => trans('backpack::crud.Status'),
            'type'  => 'text'
        ]);
        CRUD::addColumn([
            'name'  => 'ra',
            'label' => trans('backpack::crud.Ra'),
            'type'  => 'text'
        ]);
        CRUD::addColumn([
            'name'  => 'password',
            'label' => trans('backpack::crud.Password'),
            'type'  => 'text'
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
        CRUD::setValidation(StudentRequest::class);

        CRUD::addField([
            'name' => 'name',
            'label'=> trans('backpack::crud.Name'),
            'type' => 'text',
            'hint' => trans('backpack::hints.students.name'),
            'attributes' => [
                'placeholder' => trans('backpack::hints.students.name')
            ],
            'tab' => trans('backpack::crud.tab.basic')
        ]);

        CRUD::addField([
            'name'      => 'university_id',
            'tab' => trans('backpack::crud.tab.basic'),
            'label'=> trans('backpack::crud.University'),
            'prefix' => '<i class="fas fa-list-ul"></i>',
            'hint' => trans('backpack::hints.students.university'),
            'type'      => 'select2',
            'entity'    => 'University',
            'attribute' => 'name',
            'model'     => "App\Models\University",
            'wrapper' => ['class' => 'form-group col-md-4'],
        ]);

        CRUD::addField([
            'name' => 'phone',
            'label'=> trans('backpack::crud.Phone'),
            'type' => 'text',
            'hint' => trans('backpack::hints.students.phone'),
            'wrapper' => ['class' => 'form-group col-md-4'],
            'attributes' => [
                'placeholder' => trans('backpack::hints.students.phone')
            ],
            'tab' => trans('backpack::crud.tab.basic')
        ]);

        CRUD::addField([
            'name' => 'email',
            'label'=> trans('backpack::crud.Email'),
            'type' => 'text',
            'hint' => trans('backpack::hints.students.email'),
            'wrapper' => ['class' => 'form-group col-md-4'],
            'attributes' => [
                'placeholder' => trans('backpack::hints.students.email')
            ],
            'tab' => trans('backpack::crud.tab.basic')
        ]);

        CRUD::addField([
            'name' => 'ra',
            'label'=> trans('backpack::crud.Ra'),
            'type' => 'text',
            'hint' => trans('backpack::hints.students.ra'),
            'attributes' => [
                'placeholder' => trans('backpack::hints.students.ra')
            ],
            'tab' => trans('backpack::crud.tab.access')
        ]);

        CRUD::addField([
            'name' => 'password',
            'label'=> trans('backpack::crud.Password'),
            'type' => 'text',
            'hint' => trans('backpack::hints.students.password'),
            'attributes' => [
                'placeholder' => trans('backpack::hints.students.password')
            ],
            'tab' => trans('backpack::crud.tab.access')
        ]);
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
