<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Mail\ContactMail;
use App\Mail\ThanksForContactMail;

use App\Http\Requests\Client\CreateContactRequest;

use App\Http\Controllers\ClientController;

use View;
use Redirect;
use App\Page;

class PagesController extends ClientController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('index');

        // if (!env("CLTVO_DEV_MODE")) {
    	// 	return view('welcome');
    	// }
    	dd('Página de Inicio de Blank App');
        //return Redirect::route('client::login:get');
    }

    public function contact(CreateContactRequest $request)
    {
        $input = $request->all();

        $first_name = $input['first_name'];
        $last_name  = $input['last_name'];
        $full_name  = $first_name.' '.$last_name;

        $street1    = $input['address']['street1'];
        $street2    = $input['address']['street2'];
        $city       = $input['address']['city'];
        $state      = $input['address']['state'];
        $country    = $input['address']['country'];
        $zip        = $input['address']['zip'];

        $phone      = $input['phone'];
        $email      = $input['email'];

        $content = [
            'Nombre: '   .$full_name,
            'Correo: '   .$email,
            'Teléfono: ' .$phone,
            'Dirección: '.$street1.' '.$street2.', '.$city.', '.$state.', '.$country.', '.$zip,
        ];

        Mail::to('dev@elcultivo.mx')->send(new ContactMail($content, $email, $first_name));

        Mail::to($email)->send( new ThanksForContactMail($full_name) );

        return Redirect::back()->with('status', "¡Muchas gracias! Hemos recibido tu mensaje correctamente, pronto recibirás un correo de confirmación.");

    }

    // public function show(Page $public_page)
    // {
    //     $view = 'client.pages.'.$public_page->translation('es')->slug;
    //
    //     if (!View::exists($view)) {
    //         $view = 'client.pages.template';
    //     }
    //
    //     return view($view);
    // }


}
