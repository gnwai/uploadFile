<?php

namespace Wubuze\UploadFile;

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

//        $this->publishes([
//            __DIR__.'/../database/migrations' => database_path('migrations'),
//        ], 'wubuze-file-migrations');


    }




    protected function registerConfig()
    {

        $path = realpath(__DIR__.'/../config/storage.php');

        $this->publishes([$path => config_path('storage.php')], 'wubuze-file-config');

        $this->mergeConfigFrom($path, 'storage');
    }


}