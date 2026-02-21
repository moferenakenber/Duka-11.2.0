<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class LogVisitToDiscord
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Skip common "noise" visits (like favicons or the health check itself)
        $path = $request->path();
        $ignoredPaths = ['favicon.ico', 'health', 'robots.txt'];

        if (!in_array($path, $ignoredPaths)) {
            $url = env('DISCORD_WEBHOOK_URL');

            if ($url) {
                // We use a background-friendly way to send this
                // so it doesn't slow down the page for the user
                try {
                    Http::post($url, [
                        'content' => "👀 **New Visitor!**\n**Path:** /{$path}\n**IP:** " . $request->ip() . "\n**Agent:** " . substr($request->userAgent(), 0, 50) . "..."
                    ]);
                } catch (\Exception $e) {
                    // Fail silently so the user still sees the site
                }
            }
        }

        return $next($request);
    }
}
