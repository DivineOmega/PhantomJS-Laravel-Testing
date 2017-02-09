<?php
namespace DivineOmega\PhantomJSLaravelTesting\Http\Controllers;

use App\Http\Requests;
use Exception;

class SessionController
{
    public function put(Request $request)
    {
        $value = unserialize(base64_decode($request->value));

        $request->session()->put($request->key, $value);
    }

    public function get(Request $request)
    {
         $value = $request->session()->get($request->key);

         return base64_encode(serialize($value));
    }

}