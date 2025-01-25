<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Http\Middleware\MiddlewarePriority;

/*$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);
$app->middleware([
    'web' => [
        // Otros middlewares del grupo 'web'...
        RoleMiddleware::class,
    ],
]);
return $app;*/

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        //api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $routeMiddleware = [

            'auth' => Authenticate::class,
            'role' => RoleMiddleware::class
        ];
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
