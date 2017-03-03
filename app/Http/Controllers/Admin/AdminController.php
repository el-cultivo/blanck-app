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
        $data = [
			'items' => [
				[
					'icon'  		=> 'perm_identity',
					'label' 		=> 'Usuarios',
					'route_name' 	=> 'users.index',
					'permission'	=> 'manage_users',
				],
				[
					'icon'  => 'perm_media',
					'label' => 'Imágenes',
					'route_name' => 'photos.index',
					'permission'	=> 'photos_view',
				],
                [
                    'icon'  => 'mode_edit',
                    'label' => 'Páginas',
                    'route_name' => 'pages.contents.index',
                    'permission'	=> 'manage_pages_contents',
                ],
                [
                    'icon'  => 'web',
                    'label' => 'Páginas',
                    'route_name' => 'pages.index',
                    'permission'	=> 'manage_pages',
                ],
				[
					'icon'  => 'settings',
					'label' => 'Ajustes del Sistema',
					'route_name' => 'settings.index',
					'permission'	=> 'system_config',
				],
                [
                    'icon'  => 'http',
                    'label' => 'Rutas',
                    'route_name' => 'site_map',
                    'permission'	=> 'manage_pages',
                ],
				[
					'icon'  => 'library_books',
					'label' => 'Manuales',
					'route_name' => 'manuals',
					'permission'	=> 'admin_access',
				],
			]
		];
        return view('admin.index',$data);
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
