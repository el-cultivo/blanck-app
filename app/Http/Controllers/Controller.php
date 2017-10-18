<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Auth;
use View;

use App\Models\Language;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * autenficacion de usuario
     * @var \App\Models\Users\User|null
     */
    protected $user;

    /**
     * 	si el usuario esta logeado
     *
     * @var \App\Models\Users\User|null
     */
    protected $signedIn;


    /**
     * si el usuario es super admin
     *
     * @var boolean
     */
    protected $userIsSuperAdmin = false;

    /**
     * arreglo de setting que se cargaran con la pagina
     *
     * @var array
     */
    protected $settings = [
        // "key"   => null
    ];

    protected $languages;

    protected $current_language;

    /**
     * crea un nuevo controlador
     */
    public function __construct(){

        $this->middleware(function ($request, $next) {

            $this->reconstructController();

            if (method_exists($this,"constructClientController")  ) {
                $this->constructClientController();
            }

            if (method_exists($this,"constructAdminController")  ) {
                $this->constructAdminController();
            }

            return $next($request);
        });
    }

    private function reconstructController()
    {
        // User logged
        $this->user = $this->signedIn = Auth::user(); // usuario logueado

        // User is super admin
        $this->userIsSuperAdmin = $this->user ? $this->user->isSuperAdmin() : false;

        // Get all languages for the sites
        $this->languages = Language::available()->get();

        // Language of the session page
        // Get current Language object of the site
        $current_lang_iso =  cltvoCurrentLanguageIso();
        // $this->current_language = $this->languages->where('iso6391', $current_lang_iso)->first();

        View::share("user", $this->user); // pasar a todas las vistas
        View::share("current_lang_iso", $current_lang_iso); // pasar a todas las vistas
        View::share("languages", $this->languages); // pasar a todas las vistas
    }
}
