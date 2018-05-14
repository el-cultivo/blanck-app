<?php

namespace App\Http\Requests\Admin\Settings;

use App\Http\Requests\Request;

use App\Models\Collections\Collection;

use App\Http\Requests\Admin\Settings\Traits\SocialRulesTrait;
use App\Http\Requests\Admin\Settings\Traits\MailRulesTrait;
use App\Http\Requests\Admin\Settings\Traits\ShipmentRulesTrait;

class UpdateSettingRequest extends Request
{
	use SocialRulesTrait;
	use MailRulesTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user && $this->user->hasPermission('system_config') ) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		$rulesMethodName = $this->generateMethodPrefix()."Rules";

		if (method_exists($this,$rulesMethodName)){
			return $this->{$rulesMethodName}();
		}

		return [
			"key_method"	=>	"required|in:".str_random(40)
		];

    }

	public function messages()
    {
		$setting_key = $this->route()->parameters()["setting_key"];

		$rulesMethodName = $this->generateMethodPrefix()."Messages";

		if (method_exists($this,$rulesMethodName)){
			return $this->{$rulesMethodName}();
		}

        return [
            'key_method.required' 	=> trans('manage_settings.update.setting.key_method.required', ['setting_key' => $setting_key] ),
            'key_method.in' 		=> trans('manage_settings.update.setting.key_method.in', ['setting_key' => $setting_key] ),
        ];
    }

	protected function generateMethodPrefix()
	{
		$setting_key = $this->route()->parameters()["setting_key"];
		return "get".ucfirst(camel_case($setting_key));
	}

}
