<?php

namespace App\Providers;

use App\Actions\PusherSanctumBroadcaster;
use App\Models\User;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        URL::forceScheme('https');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(BroadcastManager $broadcastManager): void
    {
        Paginator::useBootstrapFive();
        Scramble::afterOpenApiGenerated(function (OpenApi $openApi) {
            $openApi->secure(
                // SecurityScheme::apiKey('query', 'api_token')
                SecurityScheme::http('bearer')
            );
        });
        Gate::define('viewApiDocs', function (?User $user) {
            return $user !== null;

            return in_array($user->email, ['admin@app.com']);
        });
        $broadcastManager->extend('pusher-sanctum', function (Application $app, array $config) use ($broadcastManager) {
            return new PusherSanctumBroadcaster($broadcastManager->pusher(config('broadcasting.connections.pusher')));
        });
    }
}
