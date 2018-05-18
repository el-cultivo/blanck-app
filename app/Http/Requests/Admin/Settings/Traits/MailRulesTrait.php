<?php

namespace App\Http\Requests\Admin\Settings\Traits;

trait MailRulesTrait {



	public function getMailRules()
	{
		$rules = [
			'contact'           => 'required|email',
			'system'            => 'required|email',
			'notifications'     => 'required|email',
		];

		foreach ($this->languages_isos as $iso) {
			$rules['unattendance_copy.'.$iso]   = 'string';
			$rules['register_copy.'.$iso]   = 'string';
			$rules['purchase_copy.'.$iso]   = 'string';
			$rules['thanks_copy.'.$iso]     = 'string';
			$rules['mail_greeting.'.$iso]   = 'string';
			$rules['mail_farewell.'.$iso]   = 'string';
		}

		return $rules;
	}

}
