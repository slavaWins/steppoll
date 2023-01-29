<?php

namespace Steppoll\Providers;

use Illuminate\Support\ServiceProvider;
use Steppoll\Console\Commands\ExampleCommand;
use Steppoll\Console\Commands\MakePackage;

class SteppollServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'steppoll');


        $migrations_path = __DIR__ . '/../copy/Polls';
        $this->publishes([
            $migrations_path => app_path('Polls'),
        ], 'public');


        $migrations_path = __DIR__ . '/../copy/views';
        if (file_exists($migrations_path)) {
            $this->publishes([
                $migrations_path => resource_path('views'),
            ], 'public');
        }


        $js_path = __DIR__ . '/../copy/js';
        if (file_exists($js_path)) {
            $this->publishes([
                $js_path => public_path('js'),
            ], 'public');
        }


    }
}
