<?php

namespace DivineOmega\PhantomJSLaravelTesting\Objects;

use Illuminate\Foundation\Testing\TestCase as IlluminateTestCase;

class LaravelTestCase extends IlluminateTestCase
{
    public function createApplication()
    {
        $unitTesting = true;
        $testEnvironment = 'testing';
        return require __DIR__.'/../../bootstrap/start.php';
    }
}