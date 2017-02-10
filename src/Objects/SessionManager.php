<?php

namespace DivineOmega\PhantomJSLaravelTesting\Objects;

use URL;

class SessionManager
{
    private $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function put($key, $value) 
    {
        $value = base64_encode(serialize($value));

        $uri = URL::to('/_pjslt/session/put/'.$key.'/'.$value);
        $this->driver->get($uri);
    }

    public function get($key) 
    {
        $uri = URL::to('/_pjslt/session/get/'.$key);
        $this->driver->get($uri);
        
        $source = $this->driver()->getPageSource();

        $value = unserialize(base64_decode($source));

        return $value;
    }
}