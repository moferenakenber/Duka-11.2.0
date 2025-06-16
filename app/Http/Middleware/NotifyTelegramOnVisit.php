<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Services\TelegramService;

class NotifyTelegramOnVisit
{
    protected $telegram;

    public function __construct(TelegramService $telegram)
    {
        $this->telegram = $telegram;
    }

    public function handle($request, Closure $next)
    {
        // Limit to web requests (not API or console)
        if ($request->isMethod('get') && !$request->is('telescope*')) {
            $visits = Cache::get('daily_visits', []);

            $visits[] = [
                'user'     => Auth::check() ? Auth::user()->email : 'Guest',
                'ip'       => $request->ip(),
                'method'   => $request->method(),
                'url'      => $request->fullUrl(),
                'referrer' => $request->header('referer') ?? 'Direct',
                'agent'    => $request->userAgent(),
                'time'     => now()->format('Y-m-d H:i:s'),
            ];

            Cache::put('daily_visits', $visits, now()->addDay());
        }

        return $next($request);
    }
}
