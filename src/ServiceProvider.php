<?php

namespace NogorSolutionsLTD\Auth;

use Illuminate\Support\Facades\File;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/publish/components' => resource_path('views/components'),
        ], 'nogor-solutions-ltd-auth');
    }
}
