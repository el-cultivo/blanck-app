<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Setting;

class EmailLayoutComposer
{
	public function compose(View $view)
	{
        $social_networks = Setting::getSocialNetworks();
		$view->with('social_networks', $social_networks);
	}
}
