<?php

namespace App\Listeners;

use App\Services\TelegramService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;

use App\Events\UserCreated;

class SendTelegramNotification
{
    protected $telegramService;

    /**
     * Create the event listener.
     */
    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        //$telegramService->sendMessage('Test message');
        Log::info('SendTelegramNotification listener triggered.');

        $user = $event->user;

            // Check for null values and set a default if necessary
        $first_name = $user->first_name ?? 'N/A';  // Default to 'N/A' if first_name is null
        $email = $user->email ?? 'N/A';  // Default to 'N/A' if email is null

        $message = "🎉 New User Signup!\n\nName: {$first_name}\nEmail: {$email}";
        $chatId = env('TELEGRAM_CHAT_ID');

         // Log the message being sent
        Log::info('Sending message to Telegram: ' . $message);

        $response = $this->telegramService->sendMessage($message);

        if ($response) {
            Log::info('Telegram message sent successfully.');
        } else {
            Log::error('Failed to send Telegram message.');
        }

        Log::info('Telegram response: ' . $response);
    }

}

    // public function handle(UserCreated $event): void
    // {
    //     $user = $event->user;

    //     $message = "🎉 New User Signup!\n\nName: {$user->name}\nEmail: {$user->email}";
    //     $chatId = env('TELEGRAM_CHAT_ID');

    //     $this->telegramService->sendMessage($chatId, $message);
    // }
