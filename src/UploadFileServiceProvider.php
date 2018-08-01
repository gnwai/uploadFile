<?php

namespace UploadFile;

use Illuminate\Support\ServiceProvider;

class UploadFileServiceProvider extends ServiceProvider{


    public function boot()
    {
        $this->registerMigrations();
        $this->registerConfig();
    }

    protected function registerMigrations()
    {
//        if (Passport::$runsMigrations) {
             $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//        }

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'passport-migrations');
    }

    protected function registerConfig()
    {
//        $this->publishes([
//            __DIR__.'/../config/config.php' => config_path('storage.php'),
//        ]);

        $path = realpath(__DIR__.'/../config/config.php');

        $this->publishes([$path => config_path('storage.php')], 'config');
        $this->mergeConfigFrom($path, 'storage');
    }


}