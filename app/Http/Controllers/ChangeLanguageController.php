<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;
use App;
use Config;
use Session;
use Lang;

use App\Models\Language;
// use Request;


class ChangeLanguageController extends ClientController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeLang(Language $language ,Request $request)
    {
        dd($language);
        $laguagesArray = Language::GetLanguagesIso()->toArray();

        $previousUrl = Session::get('_previous')['url'];

        $server = $request->root()."/";

        $previousUrlParts =  explode("/",str_replace($server,"",$previousUrl )) ;


        // Verifica que el lang al cual quieres ir está en los lenguages disponibles
        if (!in_array( $lang , $laguagesArray)) {
            return view("errors.404");
        }

        if (!$previousUrl || (isset($previousUrlParts[0]) && $previousUrlParts[0] == "lang") ) {
            return Redirect::to($lang) ;
        }

        session(['lang' => $lang]);

        App::setLocale( $lang );

        Config::set('app.locale_prefix', $lang );

        if ( !isset($previousUrlParts[0]) || !in_array($previousUrlParts[0], $laguagesArray) || $lang == $previousUrlParts[0]  ) {
            return Redirect::back();
        }

        $trasnlateUrl = $lang."/";

        if (count($previousUrlParts) > 1) {

            $routesTrans = Lang::get("routes", [], $previousUrlParts[0]);


            array_shift($previousUrlParts);

            foreach ($previousUrlParts as $key => $part) {


                $key = array_search($part, $routesTrans);


                $trasnlateUrl .= ($key ? Lang::get("routes.".$key, [], $lang) : $part)."/";

            }
        }

        // dd($previousUrl,$trasnlateUrl);

        return Redirect::to($trasnlateUrl);

    }
}
