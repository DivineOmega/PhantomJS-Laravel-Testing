<?php

namespace DivineOmega\PhantomJSLaravelTesting\Objects;

use Illuminate\Foundation\Testing\TestCase as IlluminateTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LaravelTestCase extends IlluminateTestCase
{
    public function createApplication()
    {
        $unitTesting = true;
        $testEnvironment = 'testing';
        return require __DIR__.'/../../bootstrap/start.php';
    }
}