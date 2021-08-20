<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class HelperFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('helper',function() {
            return new \App\Http\Controllers\CustomHelperController;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
