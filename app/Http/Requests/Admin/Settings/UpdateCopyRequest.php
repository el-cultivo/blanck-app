<?php

namespace App\Http\Requests\Admin\Settings;

use App\Http\Requests\Request;

use App\Models\Collections\Collection;

class UpdateCopyRequest extends Request
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

        $rules = [
            'value'           => 'required|array',
        ];

        foreach ($this->languages_isos as $iso) {
            $rules['value.'.$iso]   = 'present|string';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'value.required' => trans('manage_settings.update.copy.value.required'),
            'value.array' => trans('manage_settings.update.copy.value.array'),
        ];

         foreach ($this->languages_isos as $lang_iso) {

          $messages['value.'.$lang_iso.'.present'] = trans('manage_settings.update.copy.value.'.$lang_iso.'.present');
          $messages['value.'.$lang_iso.'.string'] = trans('manage_settings.update.copy.value.'.$lang_iso.'.string');
        }

        return $messages;


    }
}
