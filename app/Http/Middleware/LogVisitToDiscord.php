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

        // Skip ignored paths
        if ($request->is('favicon.ico', 'robots.txt', 'api/*', 'build/*', 'assets/*')) {
            return;
        }

        try {
            $ip = $request->ip();

            // Cache GeoIP for 24 hours so we don't spam the API
            $geo = Cache::remember("geo_ip_{$ip}", 86400, function () use ($ip) {
                $res = Http::get("http://ip-api.com/json/{$ip}?fields=status,country,countryCode,city");
                return $res->successful() ? $res->json() : null;
            });

            $location = ($geo && ($geo['status'] ?? '') === 'success')
                ? "{$geo['city']}, {$geo['country']}"
                : "📍 Unknown";

            // SYNC POST: No async() here. We want PHP to wait for Discord.
            Http::timeout(5)->post($url, [
                'embeds' => [
                    [
                        'title' => "🛰️ Live Visit Detected",
                        'color' => 3066993,
                        'description' => "**URL:** " . $request->fullUrl() .
                            "\n**Location:** {$location}" .
                            "\n**IP:** `{$ip}`" .
                            "\n**User:** " . ($request->user() ? "👤 " . $request->user()->first_name : "👤 Guest"),
                        'timestamp' => now()->toIso8601String(),
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            // Silently log if Discord fails
            \Log::error("Discord Middleware Error: " . $e->getMessage());
        }
    }
}
