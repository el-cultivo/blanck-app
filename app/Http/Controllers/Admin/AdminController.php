<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Route;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manuals()
    {
        return view('admin.manuals');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function siteMap()
    {
        $data =[
            "route_groups"  => collect(Route::getRoutes())
                ->sortBy(function($route){
                    $route_name_parts =  explode(".",$route->getName());

                    if (isset($route_name_parts[1])) {
                        return str_replace(".".end($route_name_parts), "", $route->getName() );
                    }

                    $route_name_parts =  explode("::",$route->getName());

                    return isset($route_name_parts[1]) ? $route_name_parts[0] : $route->getName();
                })
                ->groupBy(function($route,$key){
                    $route_name_parts =  explode(".",$route->getName());

                    if (isset($route_name_parts[1])) {
                        return str_replace(".".end($route_name_parts), "", $route->getName() );
                    }

                    $route_name_parts =  explode("::",$route->getName());

                    return isset($route_name_parts[1]) ? $route_name_parts[0] : "errores";
                })->map(function($route_group){
                    return $route_group->sortBy(function($route){
                        return $route->getName();
                    });
                })
        ];
        return view('admin.site-map',$data);
    }


}
