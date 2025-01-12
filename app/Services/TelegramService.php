<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $botToken;
    protected $chatId;

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN'); // Set this in .env
        $this->chatId = env('TELEGRAM_CHAT_ID');     // Set this in .env
    }

    public function sendMessage($message)
    {

        Log::info("Sending message to Telegram...");
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $this->chatId,
            'text' => $message,
            'parse_mode' => 'HTML', // Optional: Allows HTML formatting in the message
        ]);

        return $response->successful();
    }
}
