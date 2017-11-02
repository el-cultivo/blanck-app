<?php

namespace App\Http\Controllers\Admin\Seo;

use Redirect;
use App\Models\Seo\Seo;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Seo\CreateSeoRequest;
use App\Http\Requests\Admin\Seo\UpdateSeoRequest;
use App\Http\Controllers\Controller;

class ManageSeoController extends Controller
{
    public function index() 
    {
        $data = ['seos' => Seo::where('parameters', '[]')->get()];
        return view('admin.seo.index', $data);
    }

    public function create() 
    {
        return view('admin.seo.create');
    }

    public function store(CreateSeoRequest $request) 
    {
        $input = $request->all();

        $seo = Seo::generate($input['route_name']);

        foreach ($this->languages as $language) {
            $seo->updateTranslationByIso($language->iso6391,[
                'title' => $input['title'][$language->iso6391],
                'description' => $input['description'][$language->iso6391],
            ]);
        }

        return Redirect::route('admin::seo.edit', ['seo' => $seo])->with('status', trans('manage_seo.store.success'));
    }

    public function edit(Seo $seo)
    {
        $data = ['seo' => $seo];
        return view('admin.seo.edit', $data);
    }

    public function update(UpdateSeoRequest $request, Seo $seo)
    {
        $input = $request->all();

        foreach ($this->languages as $language) {
            $seo->updateTranslationByIso($language->iso6391,[
                'title' => $input['title'][$language->iso6391],
                'description' => $input['description'][$language->iso6391],
            ]);
        }

        return Redirect::back()->with('status', trans('manage_seo.update.success'));
    }
}