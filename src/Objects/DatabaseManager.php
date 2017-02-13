<?php

namespace DivineOmega\PhantomJSLaravelTesting\Objects;

use URL;

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
        $args['connections'] = $connection;

        $args = base64_encode(serialize($args));
        
        $uri = URL::to('/_pjslt/db/see/'.$args);
        $this->driver->get($uri);
        
        $source = $this->driver->getPageSource();

        $count = (int) $source;

        $this->assertGreaterThan(0, $count, sprintf(
            'Unable to find row in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));
    }
}