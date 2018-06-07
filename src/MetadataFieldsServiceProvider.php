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
        $this->app->make('Aruberuto\MetadataFields\Controllers\MetadataFieldController');
    }
}
