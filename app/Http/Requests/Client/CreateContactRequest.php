<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Request;

class CreateContactRequest extends Request
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
            "first_name"        => "required|string",
            "last_name"         => "required|string",
            "message"           => "present|string",
            "email"             => "required|email",
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => trans('contact_form.first_name.required'),
            'first_name.string' => trans('contact_form.first_name.string'),

            'last_name.required' => trans('contact_form.last_name.required'),
            'last_name.string' => trans('contact_form.last_name.string'),

			'message.present' => trans('contact_form.message.present'),
            'message.string' => trans('contact_form.message.string'),

            'email.required' => trans('contact_form.email.required'),
            'email.email' => trans('contact_form.email.email'),
        ];
    }
}
