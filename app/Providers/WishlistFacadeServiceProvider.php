<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class WishlistFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('wishlist',function() {
            return new \App\Http\Controllers\WishlistController;
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
