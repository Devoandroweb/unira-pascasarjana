<?php

use App\Http\Middleware\LocalizationMiddleware;
use App\Http\Middleware\LogVisitorMiddleware;
use App\Http\Middleware\Roles;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/status', 
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/auth.php'))
                ->group(base_path('routes/trash.php'))
                ->group(base_path('routes/datatable.php'))
                ->group(base_path('routes/home.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'roles' => Roles::class,
            'logVisitor' => LogVisitorMiddleware::class
        ]);
        $middleware->web(append:[
            LocalizationMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
