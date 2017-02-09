<?php

namespace DivineOmega\PhantomJSLaravelTesting;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    private $routePrefix = '/_pjslt';

    public function boot()
    {
        $this->setupRoutes();
    }

    protected function setupRoutes()
    {
        Route::get($this->routePrefix.'/login/{userId}', [
            'uses' => 'DivineOmega\PhantomJSLaravelTesting\Http\Controllers\LoginController@login'
        ]);

        Route::get($this->routePrefix.'/logout', [
            'uses' => 'DivineOmega\PhantomJSLaravelTesting\Http\Controllers\LoginController@logout'
        ]);
    }

    public function register()
    {
        
    }
}