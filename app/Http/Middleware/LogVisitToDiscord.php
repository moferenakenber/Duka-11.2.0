<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LogVisitToDiscord
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Let the request finish first (User sees the page)
        $response = $next($request);

        // 2. NOW run the Discord logic before the process dies
        $this->logToDiscord($request);

        return $response;
    }

    private function logToDiscord(Request $request): void
    {
        $url = env('DISCORD_WEBHOOK_URL');
        if (!$url)
            return;

        if ($request->is('favicon.ico', 'robots.txt', 'api/*', 'build/*', 'assets/*'))
            return;

        try {
            $ip = $request->ip();
            $userAgent = $request->header('User-Agent');
            $referer = $request->header('referer') ?: 'Direct / Bookmark';

            $geo = Cache::remember("geo_ip_{$ip}", 86400, function () use ($ip) {
                $res = Http::get("http://ip-api.com/json/{$ip}?fields=status,country,countryCode,city,isp");
                return $res->successful() ? $res->json() : null;
            });

            $location = "📍 Unknown";
            $ispInfo = "";
            if ($geo && ($geo['status'] ?? '') === 'success') {
                $location = "{$geo['city']}, {$geo['country']}";
                $ispInfo = "\n**ISP:** `{$geo['isp']}`";
            }

            Http::timeout(5)->post($url, [
                'embeds' => [
                    [
                        'title' => "🛰️ Live Visit Detected",
                        'color' => 3066993,
                        'description' => "**URL:** [Click to View](" . $request->fullUrl() . ")",
                        'fields' => [
                            ['name' => '👤 User', 'value' => $request->user() ? "{$request->user()->first_name} (ID: {$request->user()->id})" : "Guest", 'inline' => true],
                            ['name' => '🌍 Location', 'value' => $location, 'inline' => true],
                            ['name' => '📟 IP Address', 'value' => "`{$ip}`", 'inline' => true],
                            ['name' => '🔗 Referrer', 'value' => $referer, 'inline' => false],
                            ['name' => '📱 Device / Agent', 'value' => "```" . substr($userAgent, 0, 100) . "...```", 'inline' => false],
                        ],
                        'footer' => ['text' => "Duka Traffic Monitor $ispInfo"],
                        'timestamp' => now()->toIso8601String(),
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error("Discord Middleware Error: " . $e->getMessage());
        }
    }
}
