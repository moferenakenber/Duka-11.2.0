<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User; // We are using your User model here

class SendLoginNotification
{
    public function handle(Login $event): void
    {
        // 1. Get the user object from the event
        $user = $event->user;

        // 2. Pull the webhook from your .env
        $url = env('DISCORD_WEBHOOK_URL');

        if ($url && $user) {
            try {
                // 3. Use the exact columns from your migration
                $firstName = $user->first_name;
                $lastName = $user->last_name ?? '';
                $email = $user->email;
                $role = $user->role ?? 'user';

                Http::post($url, [
                    'content' => "🔑 **Login Detected**\n" .
                        "**Name:** {$firstName} {$lastName}\n" .
                        "**Email:** {$email}\n" .
                        "**Role:** {$role}\n" .
                        "**IP:** " . request()->ip()
                ]);
            } catch (\Exception $e) {
                Log::error("Discord Alert Failed: " . $e->getMessage());
            }
        }
    }
}
