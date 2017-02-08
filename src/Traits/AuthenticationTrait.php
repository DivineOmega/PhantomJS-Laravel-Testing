<?php

namespace DivineOmega\PhantomJSLaravelTesting\Traits;

use Exception;

trait AuthenticationTrait
{
    public function actingAs($user) 
    {
        $user_id = null;

        if (is_numeric($user)) {
            $user_id = $user;
        } elseif (is_object($user) && isset($user->id) && is_numeric($user->id)) {
            $user_id = $user->id;
        }

        if ($user==null) {
            throw new Exception('The user you wish to act as is not valid. Please specify an ID or User object.');
        }

        // TODO: Set uri to login route defined in service provider
        $uri = '';

        $this->driver()->get($uri);
    }

    public function logout()
    {
        // TODO: Set uri to logout route defined in service provider
        $uri = '';

        $this->driver()->get($uri);
    }
}