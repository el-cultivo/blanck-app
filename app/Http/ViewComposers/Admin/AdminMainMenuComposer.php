<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\Contracts\View\View;

use Route;
use Auth;

class AdminMainMenuComposer
{
	protected $current_route_name = '';
	protected $route_group_name_prefix = 'admin::';

	protected function getMenuItems()
	{
		return collect([
			$this->setMenuItem('admin_access', [
				$this->setSubMenuItem('index', 'admin_access', 'index')
			]),
			$this->setMenuItem('manage_users', [
				$this->setSubMenuItem('users.create', 'manage_users', 'create'),
				$this->setSubMenuItem('users.index', 'manage_users', 'index'),
				$this->setSubMenuItem('users.trash', 'manage_users', 'trash'),
				$this->setSubMenuItem('users.edit', 'manage_users', '')
			]),
			$this->setMenuItem('photos_view', [
				$this->setSubMenuItem('photos.index', 'photos_view', 'index')
			]),
			$this->setMenuItem('manage_pages_contents', [
				$this->setSubMenuItem('pages.contents.index', 'manage_pages_contents', 'contents.index'),
				$this->setSubMenuItem('pages.contents.edit', 'manage_pages_contents', ''),
				$this->setSubMenuItem('pages.create', 'manage_pages', 'create'),
				$this->setSubMenuItem('pages.index', 'manage_pages', 'index'),
				$this->setSubMenuItem('pages.edit', 'manage_pages', ''),
				$this->setSubMenuItem('pages.sections.index', 'manage_pages', 'sections.index')
			]),
			$this->setMenuItem('system_config', [
				$this->setSubMenuItem('copies.index', 'system_config', 'copies.index'),
				$this->setSubMenuItem('shapes.index', 'system_config', 'shapes.index'),
				$this->setSubMenuItem('settings.index', 'system_config', 'settings.index'),
				$this->setSubMenuItem('seo_booster.index', 'manage_seo_booster', 'seo_booster.index')
			]),
			$this->setMenuItem('routes_view', [
				$this->setSubMenuItem('site_map', 'routes_view', 'site_map')
			]),
			$this->setMenuItem('admin_access_manuals', [
				$this->setSubMenuItem('manuals', 'admin_access', 'videos')
			])
		]);
	}

	public function __construct()
	{
		$this->current_route_name = str_replace($this->route_group_name_prefix, '', Route::currentRouteName());
    }

	public function compose(View $view)
	{
		$view->with('menu_items', $this->constructMenuMap());
		$view->with('route_group_prefix', $this->route_group_name_prefix);
	}

	protected function isActiveSection(array $route_names = [])
	{
		return in_array($this->current_route_name, $route_names);
	}

	public function constructMenuMap()
	{
		$user = Auth::user();

		return $this->getMenuItems()->filter(function($menu_item) use ($user){
			$permissions = $menu_item->routes->pluck('permission');
			return $user->hasPermission($permissions->unique()->toArray());
		})->map(function($menu_item) use ($user){
			return (object) [
				'label'		=> trans($menu_item->label.".admin_menu.label"),
				'current'	=> $this->isActiveSection($menu_item->routes->pluck('name')->toArray()),
				'sub_menu'	=> $menu_item->routes->filter(function($sub_menu_item) use ($user,$menu_item){
					return !empty($sub_menu_item->label) && $user->hasPermission($sub_menu_item->permission);
				})->map(function($sub_menu_item) use ($menu_item){
					return (object) [
						'name'			=> $sub_menu_item->name,
						'permission'	=> $sub_menu_item->permission,
						'label'			=> trans($menu_item->label.".admin_menu.".$sub_menu_item->label),
					];;
				})
			];
		});
	}

	protected function setSubMenuItem($route_name, $permission, $label)
	{
		return (object) [
			'name'			=> $route_name,
			'permission'	=> $permission,
			'label'			=> $label
		];
	}


	protected function setMenuItem($label, array $sub_menu)
	{
		return (object) [
			'label'		=> $label,
			'routes'	=> collect($sub_menu)
		];
	}
}
