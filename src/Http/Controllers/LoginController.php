<?php
namespace DivineOmega\PhantomJSLaravelTesting\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class LoginController extends BaseController
{
    public function login($userId)
    {
        $result = Auth::loginUsingId($userId);

        if (!$result) {
            throw new Exception('Unable to act as specified user. Please ensure the specified user exists.');
        }
    }

    public function logout()
    {
        $result = Auth::logout();

        if (!$result) {
            throw new Exception('Unable to logout.');
        }
    }
}