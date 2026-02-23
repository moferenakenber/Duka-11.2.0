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
        return $next($request);
    }

    // This runs AFTER the user sees the page
    public function terminate(Request $request, Response $response): void
    {
        $path = $request->path();
        $ignoredPaths = ['favicon.ico', 'health', 'robots.txt', 'api/*'];

        foreach ($ignoredPaths as $ignored) {
            if ($request->is($ignored))
                return;
        }

        $url = env('DISCORD_WEBHOOK_URL');
        if (!$url)
            return;

        $ip = $request->ip();

        // 1. Get Geo Data (Free API - no key required for low traffic)
        $geo = Http::get("http://ip-api.com/json/{$ip}?fields=status,country,countryCode,city")->json();

        $location = "📍 Unknown";
        if ($geo && $geo['status'] === 'success') {
            $flag = $this->getFlagEmoji($geo['countryCode']);
            $location = "{$flag} {$geo['city']}, {$geo['country']}";
        }

        // 2. Send to Discord
        Http::async()->post($url, [
            'embeds' => [
                [
                    'title' => "🛰️ Live Visit Detected",
                    'color' => 3066993, // A nice blue color
                    'description' => "**URL:** " . $request->fullUrl() . "\n" .
                        "**Location:** {$location}\n" .
                        "**IP:** `{$ip}`\n" .
                        "**User:** " . ($request->user() ? "👤 " . $request->user()->first_name : "👤 Guest"),
                    'timestamp' => now()->toIso8601String(),
                ]
            ]
        ]);
    }

    /**
     * Converts ISO country code to Emoji Flag
     */
    private function getFlagEmoji($countryCode): string
    {
        if (empty($countryCode))
            return "🏳️";

        // Convert 'US' to Unicode regional indicator symbols
        return implode('', array_map(function ($char) {
            return mb_convert_encoding('&#' . (127397 + ord($char)) . ';', 'UTF-8', 'HTML-ENTITIES');
        }, str_split(strtoupper($countryCode))));
    }
}
