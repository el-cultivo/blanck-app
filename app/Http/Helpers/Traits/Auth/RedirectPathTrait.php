<?php namespace App\Http\Helpers\Traits\Auth;

use Auth;

trait RedirectPathTrait {


    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        $user = Auth::user();
        return session('CltvoPreviousURL') ? session('CltvoPreviousURL') : ($user ? (  $user->hasPermission("admin_access") ? route("admin::index") : $user->getHomeUrl() ) : route("admin::pages.index"));
    }

}
