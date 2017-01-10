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

    // public function messages()
    // {
    //     return [
    //         'first_name.required'         =>  'Olvidaste ingresar tu contraseña.',
    //         'password.password_check'   =>  'La contraseña que ingresaste es incorrecta.',
    //
    //         'email.required'            =>  'Olvidaste ingresar tu correo electrónico.',
    //         'email.email'               =>  'Ingresa una dirección de correo electrónico válida.',
    //         'email.max'                 =>  'El campo correo electrónico no puede ser mayor a 255 caracteres.',
    //         'email.unique'              =>  'La dirección de correo electrónico ya ha sido registrada.',
    //         'email.not_in'              =>  'La dirección de correo electrónico es inválida.',
    //     ];
    // }
}
