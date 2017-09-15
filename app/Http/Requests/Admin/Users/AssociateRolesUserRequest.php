<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\Request;
use App\Models\Users\User;
use App\Models\Users\Role;

class AssociateRolesUserRequest extends Request
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

        $user_editable = $this->route()->parameters()["user_editable"];

		if( $user_editable->id == $this->user->id   ){
			return [
				"same_user"	=> 	"required|in:".str_random(24),
			];
		}

        $rules = [
            'roles'         => 'required|array',
            'roles.*'       => 'required|exists:roles,id'
        ];

        if (!$this->user->isSuperAdmin()) {
            $roleSAdmin = Role::GetSuperAdmin();
            $rules['roles.*'] .= '|not_in:'.$roleSAdmin->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [

            'roles.required' => trans('users.roles.required'),
			'roles.required' => trans('users.roles.array'),

            'roles.*.required' => trans('users.roles.required'),
            'roles.*.exist' => trans('users.roles.exist'),
        ];
    }
}
