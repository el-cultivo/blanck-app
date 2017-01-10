<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Page;
use App\Setting;

class ClientMainMenuComposer
{
	public function compose(View $view)
	{
		$header_items = Page::menuMain()->home(null)->published()->orderBy('order', 'ASC')->get();
		$footer_items = Page::menuFooter()->home(null)->published()->orderBy('order', 'ASC')->get();

		$view->with('header_items',$header_items);
		$view->with('footer_items',$footer_items);
	}
}
