<?php
namespace DivineOmega\PhantomJSLaravelTesting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class DatabaseController extends BaseController
{
    public function see(Request $request)
    {
        $args = unserialize(base64_decode($request->args));

        extract($args);

        $database = $this->app->make('db');

        $connection = $connection ?: $database->getDefaultConnection();

        $count = $database->connection($connection)->table($table)->where($data)->count();

        return $count;
    }

}