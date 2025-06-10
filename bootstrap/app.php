<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\NotifyTelegramOnVisit;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check_role' => CheckRole::class,
        ]);
        // 👇 This is where you add your global middleware

        $middleware->use([
            NotifyTelegramOnVisit::class,
        ]);// 👇 This is where you add your global middleware

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
