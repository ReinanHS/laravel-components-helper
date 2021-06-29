<?php

namespace Reinanhs\LaravelComponentsHelper;

use Illuminate\Support\ServiceProvider;

class ComponentHelperServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'components_helper');
    }
}
