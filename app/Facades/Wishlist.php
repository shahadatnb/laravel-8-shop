<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Wishlist extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'wishlist';
    }
}
