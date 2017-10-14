<?php
namespace App\Http\ViewComposers\Emails;

use Illuminate\Contracts\View\View;

use App\Models\Settings\Setting;

class EmailLayoutComposer
{
	public function compose(View $view)
	{
        $social_networks = Setting::getSocialNetworks();
		$view->with('social_networks', $social_networks);
	}
}
