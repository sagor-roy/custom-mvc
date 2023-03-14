<?php

namespace App\Middleware;

use App\Base\Auth;
use App\Base\Redirect;

class GuestMiddleware
{
    public static function handler()
    {
        if (!Auth::check()) {
            return true;
        } else {
            Redirect::back('/login');
        }
    }
}
