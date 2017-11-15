<?php

namespace App\Http\Requests\Admin\Seo;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CreateSeoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user && $this->user->hasPermission('manage_seo_booster') ) {
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
            'route_name'    => 'required|max:255|unique:seo,route_name',
            'title'         => 'required|array',
            'description'   => 'required|array',
        ];

        foreach ($this->languages_isos as $lang_iso) {
            $rules['title.' . $lang_iso] = 'required|max:255';
            $rules['description.' . $lang_iso] = 'required|max:255';
        }

        return $rules;
    }

    public function messages()
    {
        return [

        ];
    }

}
