<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendTelegramNotification;

use App\Events\UserCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event-to-listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendTelegramNotification::class,
        ],

         App\Events\UserCreated::class => [
             App\Listeners\SendTelegramNotification::class,
         ],

            UserCreated::class => [
                SendTelegramNotification::class,  // Listen for UserCreated event
            ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
