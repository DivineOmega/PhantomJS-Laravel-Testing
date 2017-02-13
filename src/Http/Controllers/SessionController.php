<?php
namespace DivineOmega\PhantomJSLaravelTesting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class SessionController extends BaseController
{
    public function put(Request $request)
    {
        $value = unserialize(base64_decode($request->value));

        $request->session()->put($request->key, $value);
    }

    public function get(Request $request)
    {
         $value = $request->session()->get($request->key);

         echo base64_encode(serialize($value));
         die;
    }

}