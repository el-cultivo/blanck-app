<?php

namespace App\Http\Binds\Films;

use App\Http\Binds\CltvoBind;

use Route;

use App\Models\Films\Category;

class ManageCategoriesBind extends CltvoBind
{

    /**
     * bind methods
     */
    public static function Bind(){
    // para las allies types
        Route::bind('category', function ($category_id) {
            return Category::with('languages')->GetWithTranslations()->find($category_id);
        });
    }

}
