<?php

namespace JSCustom\Chargify\Facades;

use Illuminate\Support\Facades\Facade;

class Chargify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-chargify';
    }
}
?>