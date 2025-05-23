<?php

namespace Italofantone\Marky\Facades;

use Illuminate\Support\Facades\Facade;

class Marky extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'marky';
    }
}