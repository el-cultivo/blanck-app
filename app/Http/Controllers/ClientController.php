<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;

class ClientController extends Controller
{
    public function constructClientController()
    {
    // pagina anterior
        if (!$this->user && isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/' ) {
            session(['CltvoPreviousURL' => $_SERVER['REQUEST_URI'] ]);
        }
    }

}
