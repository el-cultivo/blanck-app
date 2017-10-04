<?php

namespace App\Http\Binds;

use App\Http\Binds\CltvoBind;
use App\Models\Settings\Copy;

use Route;

class ManageCopiesBind extends CltvoBind
{

    /**
     * bind methods
     */
    public static function Bind(){
        // para las fotos
            Route::bind('copy', function ($copy_id) {
                return Copy::GetWithTranslations()->with("languages")->find($copy_id);
            });

    }

}
