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
        $this->loadViewsFrom(__DIR__.'/resources/views', 'fields');

        $this->publishes([__DIR__.'/resources/views' => base_path('resources/views/vendor/metadata-fields'),]);
        $this->publishes([
            __DIR__.'/public/js' => public_path('vendor/aruberuto/metadata-fields/js'),
            __DIR__.'/public/css' => public_path('vendor/aruberuto/metadata-fields/css'),
            __DIR__.'/public/fonts' => public_path('fonts/vendor')
        ], 'public');

        if (! class_exists('CreateMetadataTable')) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__.'/../database/migrations/create_metadata_table.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_metadata_table.php",
            ], 'migrations');
        }


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once(__DIR__ . '/helpers/helper.php');
        $this->app->make('Aruberuto\MetadataFields\Controllers\MetadataFieldController');
    }
}
