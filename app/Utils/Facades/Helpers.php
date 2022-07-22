<?php

namespace App\Utils\Facades;
use Illuminate\Support\Facades\Facade;
class Helpers extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'helpers';
    }
}