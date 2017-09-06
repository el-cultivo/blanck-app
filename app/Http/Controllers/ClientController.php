<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings\Copy;
use App\Models\Settings\Shape;

use View;
use Auth;
use Route;

class ClientController extends Controller
{
    protected $page_copies;
    protected $page_shapes;

    public function constructClientController()
    {
        $show_empty_copy = Auth::user() && Auth::user()->hasPermission('system_config');

    // copies
        $this->page_copies = Copy::with("languages")->byRoute(Route::currentRouteName())->get()->each(function($copy) use ($show_empty_copy) {
            View::share($copy->variable_name, $show_empty_copy && empty($copy->value) ? trans('general.no_description')  :  $copy->value); // pasar a todas las vistas
        });

    // shapes
        $this->page_shapes = Shape::with("photos")->byRoute(Route::currentRouteName())->get()->each(function($shape) use ($show_empty_copy) {
            $image = $shape->thumbnail_image;
            $image->url = $show_empty_copy && empty($image->url) ? asset('images/box.jpg')  : $image->url;
            View::share($shape->variable_name, $image); // pasar a todas las vistas
        });

    }

}
