<?php

namespace App\Http\Requests\Admin\Settings;

use App\Http\Requests\Request;

use App\Models\Collections\Collection;

class UpdateSettingRequest extends Request
{
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
        $setting_key = $this->route()->parameters()["setting_key"];

        switch ($setting_key) {
            case 'blog':
                $rules = [
                    'url'          => 'required|url',
                ];
                break;

            case 'social':
                $rules = [
                    'facebook'      => 'url', //active_url|
                    'twitter'       => 'url', //active_url|
                    'instagram'     => 'url', //active_url|
                    'pinterest'     => 'url', //active_url|
                ];
                break;

            case 'mail':
                $rules = [
                    'contact'           => 'required|email',
                    'system'            => 'required|email',
                    'notifications'     => 'required|email',
                ];

                foreach ($this->languages_isos as $iso) {
                    $rules['register_copy.'.$iso]   = 'string';
                    $rules['purchase_copy.'.$iso]   = 'string';
                    $rules['thanks_copy.'.$iso]     = 'string';
                    $rules['mail_greeting.'.$iso]   = 'string';
                    $rules['mail_farewell.'.$iso]   = 'string';
                }

                break;

            case 'shipment':
                $rules = [
                    'origin-address.street-1'       => 'required|string',
                    'origin-address.street-2'       => 'required|string',
                    'origin-address.street-3'       => 'required|string',
                    'origin-address.city'           => 'required|string',
                    'origin-address.state'          => 'required|string',
                    'origin-address.country'        => 'required|string',
                    'origin-address.zip'            => 'required|string|estafeta_zip',
                    'average-weight'                => 'required|numeric',
                    'minimal-clothing'              => 'required|integer|min:0',
                ];
                break;

            case 'exchange_rate':
                $rules = [
                    'US.currency' => 'required|string',
                    'US.exchange' => 'required|numeric',
                ];
                break;

            case 'event_expiration':
                $rules = [
                    'time' => 'required|integer|min:0',
                ];
                break;

            case 'card_cost':
                $rules = [
                    'cost' => 'required|numeric|min:0',
                ];
                break;

            default:
                $rules = [];
                break;
        }

        return $rules;
    }
}
