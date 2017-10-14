<?php
namespace App\Http\ViewComposers\Client;

use Illuminate\Contracts\View\View;

use App\Models\Settings\Setting;
use Auth;

class ClientLayoutComposer
{
	public function compose(View $view)
	{
        $social_networks = Setting::getSocialNetworks();
		$view->with('social_networks', $social_networks);
	}
}
