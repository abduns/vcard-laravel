<?php

declare(strict_types=1);

namespace Dunn\VCard\Laravel\Tests;

use Dunn\VCard\Laravel\Providers\VCardServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [VCardServiceProvider::class];
    }
}
