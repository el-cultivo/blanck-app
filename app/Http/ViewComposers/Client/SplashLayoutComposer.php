<?php
namespace App\Http\ViewComposers\Client;

use Illuminate\Contracts\View\View;

use App\Models\Settings\Setting;
use Auth;

class SplashLayoutComposer
{
	public function compose(View $view)
	{
		$view->with('current_lang_iso', cltvoCurrentLanguageIso());
	}
}
