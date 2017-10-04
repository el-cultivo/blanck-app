<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Settings\UpdateSettingRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Settings\Setting;

use Response;
use Redirect;

class ManageSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'setting_social'            => Setting::getSocialNetworks(),
            'setting_mail'              => Setting::getMail(),
        ];
        return view('admin.settings.index', $data);
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
}
