<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class CartFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('cart',function() {
            return new \App\Http\Controllers\CartController;
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
