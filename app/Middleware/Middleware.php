<?php

namespace App\Middleware;

use App\Middleware\AuthMiddleware;

class Middleware
{
    protected $routeMiddleware = [
        'auth' => AuthMiddleware::class,
        'guest' => GuestMiddleware::class
    ];

    public function middleware($middlewareName)
    {
        $middleware = $this->routeMiddleware[$middlewareName];
        $middleware = new $middleware();
        return $middleware->handler();
    }
}
