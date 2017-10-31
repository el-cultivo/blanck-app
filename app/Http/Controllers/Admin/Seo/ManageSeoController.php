<?php

namespace App\Http\Controllers\Admin\Seo;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Seo\Seo;

use Redirect;

class ManageSeoController extends Controller
{
    public function update(Request $request)
    {
        $input = $request->all();

        $class = Seo::$associable_models[$input['seoable_type']];
        $seoable = $class::find($input['seoable_id']);

        $seo = $seoable->getOrCreateSeo();

        foreach ($this->languages as $language) {
            $seo->updateTranslationByIso($language->iso6391,[
                'title' => $input['title'][$language->iso6391],
                'description' => $input['description'][$language->iso6391],
            ]);
        }

        return Redirect::back()->with('status', trans('manage_seo.update.success'));
    }
}