<?php
namespace DivineOmega\PhantomJSLaravelTesting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Exception;
use DB;

class DatabaseController extends BaseController
{
    public function see(Request $request)
    {
        $args = unserialize(base64_decode($request->args));

        extract($args);

        $connection = $connection ?: DB::getDefaultConnection();

        $count = DB::connection($connection)->table($table)->where($data)->count();

        echo $count;
        die;
    }

}