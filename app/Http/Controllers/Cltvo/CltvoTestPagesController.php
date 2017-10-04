<?php

namespace App\Http\Controllers\Cltvo;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\ClientController;

use View;
use Auth;

class CltvoTestPagesController extends ClientController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (View::exists('cltvo.'.config("cltvo.test_view"))) {
            return view('cltvo.'.config("cltvo.test_view"));
        }
        abort('404');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($test_view)
    {
        if (View::exists('cltvo.front.'.$test_view)) {
            return view('cltvo.front.'.$test_view);
        }
		abort('404');
    }
}
