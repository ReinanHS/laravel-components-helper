<?php

namespace Reinanhs\LaravelComponentsHelper;

use Illuminate\Support\ServiceProvider;

class ComponentHelperServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'components_helper');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('components-helper.php'),
            ], 'config');

        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'components-helper');
    }
}
