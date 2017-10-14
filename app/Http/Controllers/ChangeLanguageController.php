<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;
use App;
use Config;
use Session;
use Lang;

use Exception;

use App\Models\Language;
use App\Models\Pages\Page;



class ChangeLanguageController extends ClientController
{
	protected $base_route_name = 'client::pages.index';

	protected $base_route_parameters = [];

	protected $trans_lang_routes = [
		'client::language',
	];

	protected function trasnlatePublicPageBind($value, Language $language)
	{
		$page = Page::getModelBySlug($value)->first();
		if ($page) {
			return $page->translation($language->iso6391)->slug;
		}
		return $value;
	}

	protected function trasnlatePublicChildPageBind($value, Language $language)
	{
		$page = Page::getModelBySlug($value)->first();
		if ($page) {
			return $page->translation($language->iso6391)->slug;
		}
		return $value;
	}
	
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeLang(Language $language ,Request $request)
    {
		session(['cltvo_lang' => $language->iso6391]);

		if ($request->ajax()) {
			abort("404");
		}

		try {
			$cltvo_route = $this->getRouteByUri($language,$request->headers->get('referer') );
			return Redirect::route($cltvo_route->route_name,$cltvo_route->route_parameters);
		} catch (Exception $e) {}

        return Redirect::route($this->base_route_name,$this->base_route_parameters);
    }


	protected function getRouteByUri(Language $language,$previous_url)
	{
		$route = app('router')->getRoutes()->match(app('request')->create($previous_url));
		$route_name = $route->getName();

		if (in_array($route_name, $this->trans_lang_routes)) {
			return (object) [
				"route_name"		=>		$this->base_route_name,
				"route_parameters"	=>		$this->base_route_parameters
			];
		}

		$route_parameters = collect($route->parameters())->map(function($value,$name)use ($language){

			$method_name = "trasnlate".ucfirst(camel_case($name))."Bind";

			if (method_exists($this,$method_name )) {
				$value = $this->$method_name($value, $language);
			}

			return $value;
		});

		return (object) [
			"route_name"		=>		$route_name,
			"route_parameters"	=>		$route_parameters->toArray()
		];
	}

}
