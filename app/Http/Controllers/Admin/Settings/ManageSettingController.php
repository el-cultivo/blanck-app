<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Settings\UpdateSettingRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Setting;

use Response;
use Redirect;

class ManageSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.settings.index');
        // dump(Setting::getSpecificSocialNetwork('facebook'));
        $data = [
            'setting_social'            => Setting::getSocialNetworks(),
            'setting_mail'              => Setting::getMail(),
        ];
        return view('admin.settings.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, $setting_key)
    {
        $update_setting = Setting::where('key', $setting_key)->get()->first();

        if (!$update_setting) {
            return Redirect::back()->withErrors([trans('manage_settings.error.notexist')]);
        }

        $input = $request->except(["_token", "_method"]);

        if (array_has($input, 'files')) {
            unset($input['files']);
        }

        $update_setting->value = $input;

        if (!$update_setting->save()) {
            return Redirect::back()->withErrors([trans('manage_settings.error.cantsave')]);
        }

        return Redirect::back()->with('status', trans('manage_settings.'.$setting_key.'.title').': '.trans('manage_settings.success.update'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($setting_id)
    {
        //
    }
}
