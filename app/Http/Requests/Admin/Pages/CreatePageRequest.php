<?php

namespace App\Http\Requests\Admin\Pages;

use App\Http\Requests\Request;
use App\Page;
use App\Role;

class CreatePageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user && $this->user->hasPermission('manage_pages') ) {
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
            'index'     => 'required|max:255|unique:pages,index',
            'parent_id' => 'present|exists:pages,id',
            'label'     => 'required|array',
        ];

        foreach ($this->languages_isos as $lang_iso) {
            $rules['label.'.$lang_iso] = 'required|max:255';
        }

        return $rules;
    }

    public function messages()
    {
        return [

        ];
    }

}
