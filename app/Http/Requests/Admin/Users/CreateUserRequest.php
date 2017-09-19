<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\Request;
use App\Models\Users\User;
use App\Models\Users\Role;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user && $this->user->hasPermission('manage_users') ) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => trans('users.first_name.required'),
            'first_name.max' => trans('users.first_name.max'),

            'last_name.required' => trans('users.last_name.required'),
            'last_name.max' => trans('users.last_name.max'),

            'email.required' => trans('users.email.required'),
            'email.email' => trans('users.email.email'),
            'email.max' => trans('users.email.max'),
            'email.unique' => trans('users.email.unique'),

        ];
    }

}
