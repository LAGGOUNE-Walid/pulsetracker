<?php

namespace App\Jobs;

use Throwable;
use GuzzleHttp\Client;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogMessageToTelegramJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected ?string $message)
    {
        // $this->queue = 'log';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHANNEL_ID');

        try {
            $client = new Client();
            $client->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'json' => [
                    'chat_id' => $chatId,
                    'text' => $this->message,
                    'parse_mode' => 'HTML',
                ]
            ]);
        } catch (Throwable $th) {
            dump($th);
        }
    }
}
