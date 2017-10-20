<?php

namespace App\Http\Middleware\Cltvo;

use Closure;
use Config ;
use App;
use Carbon\Carbon;

class CltvoCurrentLanguage
{
	protected $trans_lang_routes = [
		'client::language',
	];


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		// $this->setTranslateRoute($request);
		$this->setCurrentLanguage();
        return $next($request);
    }


	protected function setTranslateRoute($request)
	{
		$route	= $request->route();

		if (!in_array($route->getName(), $this->trans_lang_routes ) &&
			!$request->ajax()
		) {
			//v1
			session(['cltvo_trans_url' => $request->url()]);

			// // v2
			// session(['cltvo_trans_route' => [
			// 	"name"			=> $route->getName(),
			// 	"parameters"	=> array_map(function($parameter){
			// 		$is_model = is_object($parameter) ;
			// 		return [
			// 			"class"		=> 	$is_model ? get_class($parameter) : null,
			// 			"key"		=>	$is_model ? $parameter->{$parameter->getKeyName()} : $parameter,
			// 		];
			// 	}, $route->parameters())
			// ]]);


		}
	}

	protected function setCurrentLanguage()
	{
		$current_lang_iso = cltvoCurrentLanguageIso() ;

        Carbon::setLocale($current_lang_iso);
		App::setLocale( $current_lang_iso );

		Config::set('app.locale_prefix', $current_lang_iso );

		session(['cltvo_lang' => $current_lang_iso]);
	}


}
