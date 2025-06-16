<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Services\TelegramService;

class SendDailyVisitSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visits:send-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $telegram;

    public function __construct(TelegramService $telegram)
    {
        parent::__construct();
        $this->telegram = $telegram;
    }
    /**
     * Execute the console command.
     */
    public function handle()
        {
        $visits = Cache::pull('daily_visits', []);

        if (empty($visits)) {
            return;
        }

        $message = "📊 <b>Daily Visit Summary</b>\n";

        foreach ($visits as $visit) {
            $message .= <<<EOT

👤 <b>User:</b> {$visit['user']}
🌐 <b>IP:</b> {$visit['ip']}
🔗 <b>URL:</b> {$visit['method']} {$visit['url']}
↩️ <b>Referrer:</b> {$visit['referrer']}
📱 <b>Agent:</b> {$visit['agent']}
🕒 <b>Time:</b> {$visit['time']}

EOT;
        }

        $this->telegram->sendMessage($message);
    }
}
