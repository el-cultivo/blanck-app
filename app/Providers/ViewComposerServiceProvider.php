<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    // admin
        // view()->composer('layouts.admin', 'App\Http\ViewComposers\AdminLayoutComposer');

        view()->composer('admin.pages._basic-info-form', 'App\Http\ViewComposers\Admin\Pages\BasicInfoFormComposer');

        view()->composer('admin.general._sidebar', 'App\Http\ViewComposers\Admin\AdminMainMenuComposer');

    // front
        view()->composer('layouts.client', 'App\Http\ViewComposers\ClientLayoutComposer');
        view()->composer('client.general._menu', 'App\Http\ViewComposers\ClientMainMenuComposer');

    // email
        view()->composer('vendor.notifications.email', 'App\Http\ViewComposers\EmailLayoutComposer' );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
