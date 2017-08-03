<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Language;
use Auth;

abstract class Request extends FormRequest
{
    protected $languages_isos;
    protected $user;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->languages_isos = Language::getLanguagesIso();
        $this->user = Auth::user();

        parent::__construct();
    }

}
