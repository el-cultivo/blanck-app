<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Traits\CltvoAdminTrait;

class AdminController extends Controller
{
	use CltvoAdminTrait;

	protected $menu_items = [
		'items' => [
			[
				'icon'  		=> 'perm_identity',
				'label' 		=> 'manage_users',
				'route_name' 	=> 'users.index',
				'permission'	=> 'manage_users',
			],
			[
				'icon'  => 'perm_media',
				'label' => 'photos_view',
				'route_name' => 'photos.index',
				'permission'	=> 'photos_view',
			],
            [
                'icon'  => 'mode_edit',
                'label' => 'manage_pages.contents',
                'route_name' => 'pages.contents.index',
                'permission'	=> 'manage_pages_contents',
            ],
            [
                'icon'  => 'web',
                'label' => 'manage_pages',
                'route_name' => 'pages.index',
                'permission'	=> 'manage_pages',
            ],
			[
				'icon'  => 'settings',
				'label' => 'system_config',
				'route_name' => 'settings.index',
				'permission'	=> 'system_config',
			],
            [
                'icon'  => 'http',
                'label' => 'admin_access.site_map',
                'route_name' => 'site_map',
                'permission'	=> 'manage_pages',
            ],
			[
				'icon'  => 'translate',
				'label' => 'admin_access.translations',
				'route_name' => 'site_map',
				'permission'	=> 'translations_view',
			],
			[
				'icon'  => 'library_books',
				'label' => 'admin_access.manuals',
				'route_name' => 'manuals',
				'permission'	=> 'admin_access',
			],
		]
	];


	protected $trans_files_extensions =[
		"php"
	];

	protected $trans_paths = [
		"app",
		"database",
		"resources/lang",
		"resources/views",
		"routes"
	];

}
