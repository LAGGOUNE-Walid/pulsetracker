<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class SwooleRedisSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pulsetracker:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to pulsetracker redis server and get real time location updates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appKey = '037eb0d7-5feb-426b-8731-e77a713668ae';
        $token = '7|V4RjdYulUAT8YcR4W1DiksQqbQeMNebXR8UEJhfz052bf39f'; 
        $signature = $this->generateSignature($appKey, $token);
        Redis::connection('pulsetracker')->subscribe(["app:$appKey.$signature"], function (string $message) {
            echo $message . "\n";
        });
    }

    public function generateSignature(string $appKey, string $token): string
    {
        if (! str_contains($token, '|')) {
            throw new Exception('Invalid token format');
        }

        return hash_hmac('sha256', $appKey, hash('sha256', Str::after($token, '|')));
    }
}
