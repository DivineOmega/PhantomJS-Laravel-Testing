<?php

namespace DivineOmega\PhantomJSLaravelTesting\Objects;

use URL;
use Facebook\WebDriver\WebDriverBy;

class DatabaseManager
{
    private $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function see($table, array $data, $connection = null) 
    {
        $args = [];
        $args['table'] = $table;
        $args['data'] = $data;
        $args['connection'] = $connection;

        $args = base64_encode(serialize($args));
        
        $uri = URL::to('/_pjslt/db/see/'.$args);
        $this->driver->get($uri);
        
        $count = (int) $this->driver->findElement(WebDriverBy::tagName('body'))->getText();

        return $count;
    }
}