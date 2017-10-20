<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class UpdateEmailRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "password" => "required|password_check:".$this->user->password,
            "email" => "required|email|max:255|unique:users,email,".$this->user->id.",id|not_in:".$this->user->email
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
