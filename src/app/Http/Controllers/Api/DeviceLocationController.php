<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceLocationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class DeviceLocationController extends Controller
{
    /**
     * Get deivce locations sorted desc , data retrival is according to your quota
     *
     * @response AnonymousResourceCollection<LengthAwarePaginator<DeviceLocationResource>>
     */
    public function index(Request $request, string $device): AnonymousResourceCollection
    {
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
        $locations = $request->user()
            ->devices()
            ->where('key', $device)
            ->firstOrFail()
            ->locations()
            ->whereDate('created_at', '>=', now()->subDays($historyLimitsByDay))
            ->orderByDesc('id');

        return DeviceLocationResource::collection($locations->paginate($request->integer('per_page', 50)));
    }
}
