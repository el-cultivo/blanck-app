<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Settings\UpdateCopyRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Settings\Copy;

use Response;
use Redirect;

class ManageCopiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'copies_by_page' => Copy::GetWithTranslations()->get()->groupBy(function($copy){
                return $copy->clean_route_name;
            }),
        ];

        return view('admin.settings.copies.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCopyRequest $request, Copy $copy)
    {
        $input = $request->all();

        foreach ($this->languages as $language) {
            $copy->updateTranslationByIso($language->iso6391,[
                'value'         =>  $input["value"][$language->iso6391],
            ]);
        }

        return Redirect::back()->with('status', trans('manage_copies.'.$copy->clean_route_name.'.'.$copy->key.'.title').': '.trans('manage_copies.success.update'));
    }

}
