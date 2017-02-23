<?php

namespace App\Http\Requests\Admin\Pages;

use App\Http\Requests\Request;
use App\Page;
use App\Role;

class UpdatePageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user && ($this->user->hasPermission('manage_pages_contents') || $this->user->hasPermission('manage_pages') ) ) {
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
        $page_edit = $this->route()->parameters()["page_edit"];

        $rules = [
            'label'     => 'required|array',
        ];

        if (!$page_edit->main) {
            $rules['parent_id'] = 'present|exists:pages,id|not_in:'.$page_edit->id;
        }

        if ($this->user->hasPermission('manage_pages')) {
            $rules['index'] = 'required|max:255|unique:pages,index,'.$page_edit->id.',id';
        }

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
