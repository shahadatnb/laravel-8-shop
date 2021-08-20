<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class CustomHelper extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'helper';
    }
}
