<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCanAccessLocationsHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $date = $request->route('date');
        $historyLimitsByDay = 0;
        $subscriptions = config('paddle-subscriptions.plans');
        foreach ($subscriptions as $subscription) {
            if ($request->user()->subscribed($subscription['name'])) {
                $historyLimitsByDay = $subscription['size']['data_retention_days'];
            }
        }
        if ($historyLimitsByDay === 0) {
            $historyLimitsByDay = $subscriptions['free']['size']['data_retention_days'];
        }
        if (now()->subDays($historyLimitsByDay)->gt($date)) {
            return abort(401);
        }

        return $next($request);
    }
}
