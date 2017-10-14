<?php

namespace App\Http\Binds;

use App\Http\Binds\CltvoBind;
use App\Models\Language;
use Route;

class ManageLanguagesBind extends CltvoBind
{

    /**
     * bind methods
     */
    public static function Bind(){
    // para los lenguages
        Route::bind('language', function ($language_iso) {
            return Language::available()->where(['iso6391' => $language_iso])->first();
        });
    }

}
