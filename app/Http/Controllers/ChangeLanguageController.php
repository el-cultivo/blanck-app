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


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeLang(Language $language ,Request $request)
    {
		session(['cltvo_lang' => $language->iso6391]);

		// try {
		// 	$cltvo_route = $this->getRouteByObject($language);
		// 	return Redirect::route($cltvo_route->route_name,$cltvo_route->route_parameters);
		// } catch (Exception $e) {}

		try {
			$cltvo_route = $this->getRouteByUri($language);
			return Redirect::route($cltvo_route->route_name,$cltvo_route->route_parameters);
		} catch (Exception $e) {}

        return Redirect::route($this->base_route_name,$this->base_route_parameters);
    }


	protected function getRouteByUri(Language $language)
	{
		$route = app('router')->getRoutes()->match(app('request')->create(session( 'cltvo_trans_url', route($this->base_route_name,$this->base_route_parameters))));

		$route_name = $route->getName();
		$route_parameters = collect($route->parameters())->map(function($value,$name)use ($language){

			switch ($name) {
				case 'public_page':
					$page = Page::getModelBySlug($value)->first();
					if ($page) {
						return $page->translation($language->iso6391)->slug;
					}
					break;
				case 'public_child_page':
					$page = Page::getModelBySlug($value)->first();
					if ($page) {
						return $page->translation($language->iso6391)->slug;
					}
					break;
			}

			return $value;
		});

		return (object) [
			"route_name"		=>		$route_name,
			"route_parameters"	=>		$route_parameters->toArray()
		];
	}
	//
	// protected function getRouteByObject(Language $language)
	// {
	// 	$route = session( 'cltvo_trans_route', [
	// 		"name"			=> $this->base_route_name,
	// 		"parameters"	=> $this->base_route_parameters
	// 	] );
	//
	// 	$route_name = isset($route['name']) ?  $route['name'] : $this->base_route_name;
	// 	$route_parameters = collect( isset($route['parameters']) && is_array($route['parameters']) ?  $route['parameters'] : [] )->map(function($parameter_op)use ($language){
	//
	// 		$parameter_op = is_array($parameter_op) ? $parameter_op : [];
	// 		$parameter_op['class'] = isset($parameter_op['class']) ?  $parameter_op['class'] : "";
	// 		$parameter_op['key'] = isset($parameter_op['key']) ?  $parameter_op['key'] : null;
	//
	// 		if (method_exists($parameter_op['class'],"getTranslatedPublicParameter") ) {
	// 			$object = $parameter_op['class']::find($parameter_op['key']);
	// 			return $object ? $object->getTranslatedPublicParameter($language) : null;
	// 		}
	//
	// 		return $parameter_op['key'];
	// 	})->filter(function($parameter){
	// 		return is_string($parameter);
	// 	});
	//
	// 	return (object) [
	// 		"route_name"		=>		$route_name,
	// 		"route_parameters"	=>		$route_parameters->toArray()
	// 	];
	// }





}
