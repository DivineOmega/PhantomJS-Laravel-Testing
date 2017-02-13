<?php

namespace DivineOmega\PhantomJSLaravelTesting\Traits;

use URL;
use Carbon\Carbon;
use Closure;

trait DatabaseTrait
{
    public function seeInDatabase($table, array $data, $connection = null) 
    {
        $this->database()->see($table, $data, $connection);
    }
}