<?php
namespace App\Http\ViewComposers\Client;

use Auth;
use App\Models\Seo\Seo;
use App\Models\Settings\Setting;
use Illuminate\Contracts\View\View;

class ClientLayoutComposer
{
	public function compose(View $view)
	{
        $social_networks = Setting::getSocialNetworks();
		$view->with('social_networks', $social_networks);
		$view->with('seo', Seo::getForCurrentRoute());
	}
}
