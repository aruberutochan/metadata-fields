<?php

namespace Aruberuto\MetadataFields;

use Illuminate\Support\ServiceProvider;

class MetadataFieldsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'metadata-fields');

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/metadata-fields'),
        ]);

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Aruberuto\MetadataFields\Controllers\MetadataFieldController');
    }
}
