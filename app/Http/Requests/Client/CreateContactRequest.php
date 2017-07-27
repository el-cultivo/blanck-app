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
            "phone"             => "present",
            "email"             => "required|email",

            "address"           => "required|array",
            "address.street1"   => "present|string",
            "address.street2"   => "present|string",
            "address.city"      => "present|string",
            "address.state"     => "present|string",
            "address.country"   => "present|string",
            "address.zip"       => "present",
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => trans('create_contact.first_name.required'),
            'first_name.string' => trans('create_contact.first_name.string'),

            'last_name.required' => trans('create_contact.last_name.required'),
            'last_name.string' => trans('create_contact.last_name.string'),

            'phone.present' => trans('create_contact.phone.present'),

            'email.required' => trans('create_contact.email.required'),
            'email.email' => trans('create_contact.email.email'),

            'address.required'   =>  trans('create_contact.address.required'),
            'address.array'   =>  trans('create_contact.address.array'),

            'address.street1.present'   =>  trans('create_contact.address.street1.present'),
            'address.street1.string'   =>  trans('create_contact.address.street1.string'),

            'address.street2.present'   =>  trans('create_contact.address.street2.present'),
            'address.street2.string'   =>  trans('create_contact.address.street2.string'),

            'address.city.present'   =>  trans('create_contact.address.city.present'),
            'address.city.string'   =>  trans('create_contact.address.city.string'),

            'address.state.present'   =>  trans('create_contact.address.state.present'),
            'address.state.string'   =>  trans('create_contact.address.state.string'),

            'address.country.present'   =>  trans('create_contact.address.country.present'),
            'address.country.string'   =>  trans('create_contact.address.country.string'),

            'address.zip.present' => trans('create_contact.address.zip.present'),
        ];
    }
}
