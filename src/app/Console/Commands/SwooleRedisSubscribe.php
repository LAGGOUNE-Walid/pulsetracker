<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

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
        $appKey = "037eb0d7-5feb-426b-8731-e77a713668ae"; // // example app key to track 
        $token = "4|w7UHQ2g6nfzkWkUJK8M4svUsiC0HRfvZelGCf9b3ff22b8c7"; // example token
        $signature = $this->generateSignature($appKey, $token);

        Redis::connection('pulsetracker')
            ->subscribe(["app:$appKey.$signature"], function (string $message) {
                echo $message . "\n";
            });
    }

    public function generateSignature(string $appKey, string $token): string
    {
        return hash_hmac(
            "sha256",
            $appKey,
            hash('sha256', Str::after($token, "|"))
        );
    }
}
