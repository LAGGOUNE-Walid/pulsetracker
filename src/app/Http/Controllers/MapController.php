<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function show(Request $request, string $appKey): View
    {
        $app = $request
            ->user()
            ->apps()
            ->with([
                'devices' => function ($query) {
                    return $query->whereHas('lastLocation');
                },
                'devices.deviceType',
            ])
            ->where('key', $appKey)
            ->firstOrFail();

        return view('dashboard.map.byApp', [
            'app' => $app,
            'devices' => $app->devices->map(function ($device) {
                return [
                    'key' => $device->key,
                    'name' => $device->name,
                    'ip' => $device->lastLocation->ip_address,
                    'type' => $device->deviceType->name,
                    'location' => $device->lastLocation->location,
                ];
            }),
        ]);
    }
}
