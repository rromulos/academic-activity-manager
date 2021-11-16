<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required|unique:students,name|max:50',
            'email'    => 'unique:students,email|max:100',
            'phone'    => 'unique:students,phone|max:20',
            'ra'       => 'unique:students,ra|max:20',
            'password' => 'max:100',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('backpack::validations.students.name.required'),
            'name.max' => trans('backpack::validations.students.name.max'),
            'name.unique' => trans('backpack::validations.students.name.unique'),

            'email.max' => trans('backpack::validations.students.email.max'),
            'email.unique' => trans('backpack::validations.students.email.unique'),

            'phone.max' => trans('backpack::validations.students.phone.max'),
            'phone.unique' => trans('backpack::validations.students.phone.unique'),

            'ra.max' => trans('backpack::validations.students.ra.max'),
            'ra.unique' => trans('backpack::validations.students.ra.unique'),

            'password.max' => trans('backpack::validations.students.password.max'),
            'password.unique' => trans('backpack::validations.students.password.unique'),
        ];
    }
}
