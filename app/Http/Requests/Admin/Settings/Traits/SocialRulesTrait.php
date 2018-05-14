<?php

namespace App\Http\Requests\Admin\Settings\Traits;

trait SocialRulesTrait {



	public function getSocialRules()
	{
		return [
			'facebook'      => 'present|url', //active_url|
			// 'twitter'       => 'present|url', //active_url|
			'instagram'     => 'present|url', //active_url|
			'pinterest'     => 'present|url', //active_url|
		];;
	}

}
