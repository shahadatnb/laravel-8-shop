<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Http\Traits\PostTrait;

class AppServiceProvider extends ServiceProvider
{
    use PostTrait;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //if($this->app->environment('production')) {
            \URL::forceScheme('http');
        //}
        Paginator::useBootstrap();
        \View::share('postType', $this->postType);
    }
}
