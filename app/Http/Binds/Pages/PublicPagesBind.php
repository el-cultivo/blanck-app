<?php

namespace App\Http\Binds\Pages;

use App\Http\Binds\CltvoBind;
use App\Models\Pages\Page;
use Route;

class PublicPagesBind extends CltvoBind
{

    /**
     * bind methods
     */
    public static function Bind(){
        // para las páginas
        Route::bind('public_page', function ($page_slug) {
            return Page::notMain()->published()->getModelBySlug($page_slug)->get()->first();
        });

    }

}
