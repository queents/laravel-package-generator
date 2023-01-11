<?php

namespace Queents\LaravelPackageGenerator;

use Illuminate\Support\ServiceProvider;
use Queents\LaravelPackageGenerator\Console\LaravelPackageGenerator;

class LaravelPackageGeneratorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-package-generator.php', 'laravel-package-generator');

        //Publish Config
        $this->publishes([
            __DIR__.'/../config/tomato-settings.php' => config_path('laravel-package-generator.php'),
        ], 'config');

        //Register generate command
        $this->commands([
            LaravelPackageGenerator::class,
        ]);
    }

    public function boot(): void
    {
        //you boot methods here
    }
}
