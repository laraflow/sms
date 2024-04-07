<?php

namespace Laraflow\Sms\Tests;

use Laraflow\Sms\SmsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function getEnvironmentSetUp($app)
    {

    }

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            SmsServiceProvider::class,
        ];
    }
}
