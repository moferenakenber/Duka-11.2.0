<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Events\Attributes\Listen;

class AlertLoginVisitor
{
    public function handle(Login $event): void
    {
        $user = $event->user;
        $url = env('DISCORD_WEBHOOK_URL');

        if (!$url || !$user)
            return;

        try {
            $ip = request()->ip();

            // 1. Check Cache first (remember for 24 hours / 86400 seconds)
            $geo = Cache::remember("geo_ip_{$ip}", 86400, function () use ($ip) {
                $response = Http::get("http://ip-api.com/json/{$ip}?fields=status,country,countryCode,city");
                return $response->successful() ? $response->json() : null;
            });

            $location = "📍 Unknown";
            if ($geo && isset($geo['status']) && $geo['status'] === 'success') {
                $flag = $this->getFlagEmoji($geo['countryCode']);
                $location = "{$flag} {$geo['city']}, {$geo['country']}";
            }

            // 2. Send the Gold Security Embed
            Http::post($url, [
                'embeds' => [
                    [
                        'title' => "🔑 Secure Login: {$user->first_name}",
                        'color' => 15844367, // Gold
                        'fields' => [
                            ['name' => '👤 User', 'value' => "{$user->first_name} {$user->last_name}", 'inline' => true],
                            ['name' => '🛡️ Role', 'value' => ucfirst($user->role ?? 'user'), 'inline' => true],
                            ['name' => '📧 Email', 'value' => $user->email, 'inline' => false],
                            ['name' => '🌍 Location', 'value' => $location, 'inline' => true],
                            ['name' => '📟 IP', 'value' => "`{$ip}`", 'inline' => true],
                        ],
                        'footer' => ['text' => 'Duka Security Monitoring'],
                        'timestamp' => now()->toIso8601String(),
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("Discord Login Alert Failed: " . $e->getMessage());
        }
    }

    private function getFlagEmoji($countryCode): string
    {
        if (empty($countryCode))
            return "🏳️";
        return implode('', array_map(function ($char) {
            return mb_convert_encoding('&#' . (127397 + ord($char)) . ';', 'UTF-8', 'HTML-ENTITIES');
        }, str_split(strtoupper($countryCode))));
    }
}
