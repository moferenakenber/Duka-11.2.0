<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
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

            $ip = $request->ip();
            $method = $request->method();
            $url = $request->fullUrl();
            $referrer = $request->header('referer') ?? 'Direct';
            $agent = $request->userAgent();
            $user = Auth::check() ? Auth::user()->email : 'Guest';
            $time = now()->format('Y-m-d H:i:s');

            $message = <<<EOT
👀 <b>Page Visit</b>
<b>User:</b> {$user}
<b>IP:</b> {$ip}
<b>URL:</b> {$method} {$url}
<b>Referrer:</b> {$referrer}
<b>Agent:</b> {$agent}
<b>Time:</b> {$time}
EOT;

            $this->telegram->sendMessage($message);
        }

        return $next($request);
    }
}
