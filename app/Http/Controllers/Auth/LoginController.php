<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ClientController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Redirect;

use App\Models\Shop\BagUser;

class LoginController extends ClientController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        parent::__construct();
    }

    /**
     * Modify the operation after login
     * @param  request $request
     * @param  User $user
     * @return Redirect
     */
    public function authenticated($request , $user)
    {

        $redirect = $this->redirectPath() ;


        if( !$user->isActive() ){
            Auth::logout();
            return Redirect::back()->withErrors([
                'active' => "te enviamos un correo para activar tu cuenta"
            ]);
        }

        // $lang_iso = session("lang") ? session("lang") : "es";

        // $redirect = session('CltvoPreviousURL') ? session('CltvoPreviousURL') : $lang_iso."/".Lang::get("routes.username",[],$lang_iso)."/".rawurlencode(Auth::User()->id) ;

        $redirect = $user->hasPermission("admin_access") ? route("admin::index") : $user->getHomeUrl();

        return redirect()->intended(  $redirect );

    }
}
