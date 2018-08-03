<?php

namespace UploadFile;

use Illuminate\Support\ServiceProvider;
use UploadFile\Console\MakeSystem;

class UploadFileServiceProvider extends ServiceProvider{


    public function boot()
    {
        $this->registerMigrations();
        $this->registerConfig();

        $this->registerCommand();
        $this->commands('system.set');

    }

    protected function registerMigrations()
    {
//        if (Passport::$runsMigrations) {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//        }

//        $this->publishes([
//            __DIR__.'/../database/migrations' => database_path('migrations'),
//        ], 'wubuze-migrations');


    }


    protected function registerCommand()
    {
        $this->app->singleton('system.set', function () {
            return new MakeSystem;
        });
    }


    protected function registerConfig()
    {

        $path = realpath(__DIR__.'/../config/storage.php');
        $path2 = realpath(__DIR__.'/../config/system.php');

        $this->publishes([$path => config_path('storage.php')], 'wubuze-config');
        $this->publishes([$path2 => config_path('system.php')], 'wubuze-config');

        $this->mergeConfigFrom($path, 'storage');
    }


}