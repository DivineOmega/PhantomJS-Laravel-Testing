<?php

namespace DivineOmega\PhantomJSLaravelTesting\Traits;

use URL;
use Carbon\Carbon;
use Closure;

trait DatabaseTrait
{
    public function seeInDatabase($table, array $data, $connection = null) 
    {
        $count = $this->database()->see($table, $data, $connection);

        $this->assertGreaterThan(0, $count, sprintf(
            'Unable to find row in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));
    }
}