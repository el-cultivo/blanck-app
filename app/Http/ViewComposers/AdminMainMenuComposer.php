<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use Route;

use Auth;


class AdminMainMenuComposer
{

	protected $current_route_name = "";
	protected $route_group_name_prefix = "admin::";


	protected $menu_items = [
		"Inicio" 		=> [
			"permission" => "admin_access",
			"routes" => [
				"index"	=> "Administrador"
			]
		],


		"Usuarios" 		=> [
			"permission" => "manage_users",
			"routes" => [
			// 	route_name => label // label vacio si no se quiere mostrar la ruta pero se quere que se active la seccion
				"users.create"	=> "Agregar usuario",
				"users.index"	=> "Lista de usuarios",
				"users.trash"	=> "Usuarios desactivados",
				"users.edit"	=> ""
			]

		],

		"Imágenes"		=> [
			"permission" => "photos_view",
			"routes" => [
				"photos.index"	=> "Media Manager"
			]
		],

		"Films_ traducir "		=> [
			"permission" => "manage_films",
			"routes" => [
				// "films.create"		=> "Agregar actividad",
				// "films.index"		=> "Lista de actividades",
				// "films.edit"		=> "",

				"categories.index"		=> "Categorias de actividades",
				// "topics.index"		=> "Temas de actividades",
			]
		],

		// "Páginas" 		=> [
		// 	"permission" => "manage_pages",
		// 	"routes" => [
		// 	// 	route_name => label // label vacio si no se quiere mostrar la ruta pero se quere que se active la seccion
		// 		"pages.index"	=> "Lista de páginas",
		// 		"pages.edit"	=> ""
		// 	]
		//
		// ],

		"Ajustes" 		=> [
			"permission" => "system_config",
			"routes" => [
				"settings.index"	=> "Ajustes del sistema",
			]

		],
		"Manuales" 		=> [
			"permission" => "admin_access",
			"routes" => [
				"manuals"	=> "Videos"
			]
		],

	];

	public function __construct(){
		$this->current_route_name =  str_replace($this->route_group_name_prefix, "",  Route::currentRouteName()) ;
		$this->menu_items_collection = collect($this->menu_items);
    }

	public function compose(View $view)
	{
		$view->with('menu_items', $this->constructMenuMap() );

		$view->with('route_group_prefix', $this->route_group_name_prefix );
	}

	protected function isActiveSection(array $route_names = [])
	{
		return in_array($this->current_route_name, $route_names);
	}

	public function constructMenuMap()
	{
		$user = Auth::user();
		return $this->menu_items_collection->filter(function($menu_item) use ($user){
					return $user->hasPermission($menu_item["permission"]);
				})->map(function($menu_item){
					return [
						"current"		=> $this->isActiveSection(array_keys($menu_item["routes"])),
						"sub_menu"		=> array_filter($menu_item["routes"],function($label){
							return !empty($label);
						})
					];
				});
	}
}
