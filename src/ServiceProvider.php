<?php

namespace DivineOmega\PhantomJSLaravelTesting;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    private $routePrefix = '/_pjslt';

    public function boot()
    {
        // For security only setup routes if the environment is local and debug in on
        if (env('APP_ENV')=='local' && env('APP_DEBUG')=='true') {
            $this->setupRoutes();
        }
    }

    protected function setupRoutes()
    {
        Route::get($this->routePrefix.'/login/{userId}', [
            'uses' => 'DivineOmega\PhantomJSLaravelTesting\Http\Controllers\LoginController@login'
        ]);

        Route::get($this->routePrefix.'/logout', [
            'uses' => 'DivineOmega\PhantomJSLaravelTesting\Http\Controllers\LoginController@logout'
        ]);

        Route::get($this->routePrefix.'/session/put/{key}/{value}', [
            'uses' => 'DivineOmega\PhantomJSLaravelTesting\Http\Controllers\SessionController@put'
        ]);

        Route::get($this->routePrefix.'/session/get/{key}', [
            'uses' => 'DivineOmega\PhantomJSLaravelTesting\Http\Controllers\SessionController@get'
        ]);

    }

    public function register()
    {
        
    }
}