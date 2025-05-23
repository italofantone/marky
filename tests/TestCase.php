<?php

namespace Italofantone\Marky\Tests;

use Italofantone\Marky\MarkyServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            MarkyServiceProvider::class,
        ];
    }
}