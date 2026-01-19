<?php

namespace Tests;

use IFresh\PackageHealth\HealthServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            HealthServiceProvider::class,
        ];
    }
}
