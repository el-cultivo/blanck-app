<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings\Copy;

use View;
use Auth;
use Route;

class ClientController extends Controller
{
    protected $page_copies;

    public function constructClientController()
    {
    // pagina anterior
        if (!$this->user && isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/' ) {
            session(['CltvoPreviousURL' => $_SERVER['REQUEST_URI'] ]);
        }

        $show_empty_copy = Auth::user() && Auth::user()->hasPermission('system_config');

    // copies
        $this->page_copies = Copy::with("languages","photos")->byRoute(Route::currentRouteName())->get()->each(function($copy) use ($show_empty_copy) {
            View::share($copy->variable_name, $show_empty_copy && empty($copy->value) ? trans('general.no_description')  :  $copy->value); // pasar a todas las vistas

            //dump($copy->variable_name);
        });

    }

}
