<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

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
        // $token = env('TELEGRAM_BOT_TOKEN');
        $token = config('logging.channels.telegram.TELEGRAM_BOT_TOKEN');
        // $chatId = env('TELEGRAM_CHANNEL_ID');
        $chatId = config('logging.channels.telegram.TELEGRAM_CHANNEL_ID');

        try {
            $client = new Client;
            $client->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'json' => [
                    'chat_id' => $chatId,
                    'text' => $this->message,
                    'parse_mode' => 'HTML',
                ],
            ]);
        } catch (Throwable $th) {
            dump($th);
        }
    }
}
