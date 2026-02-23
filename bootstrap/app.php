<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\NotifyTelegramOnVisit;
use App\Http\Middleware\LogVisitToDiscord;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ✅ 1. Register Aliases
        $middleware->alias([
            'check_role' => CheckRole::class,
        ]);

        $middleware->web(append: [
            LogVisitToDiscord::class,
            //NotifyTelegramOnVisit::class,
        ]);
    })
    ->withEvents(discover: [
        __DIR__ . '/../app/Listeners', // This tells Laravel 11 to find your AlertLoginVisitor automatically!
    ])
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('visits:send-summary')->dailyAt('21:00');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
