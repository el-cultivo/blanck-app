<?php

namespace App\Providers\Cltvo;

use Illuminate\Support\ServiceProvider;
use App\Console\Cltvo\CltvoSetSiteCommand;

class SetServiceProvider extends ServiceProvider
{
	/**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSetCommand();

        $this->commands('command.set');
    }

    /**
     * Register the set console command.
     *
     * @return void
     */
    protected function registerSetCommand()
    {
        $this->app->singleton('command.set', function ($app) {
            return new CltvoSetSiteCommand($app['composer']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['seter', 'command.set'];
    }
}
