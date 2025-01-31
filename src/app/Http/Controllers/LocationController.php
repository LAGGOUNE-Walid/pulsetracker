<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Contracts\View\View;

class LocationController extends Controller
{
    public function getByDate(string $key, string $date): View
    {
        $device = Device::where('key', $key)
            ->with('app', 'app.geofences')
            ->firstOrFail();

        $app = $device->app;

        $locations = $device->locations()
            ->whereDate('created_at', $date)
            ->get()
            ->map(fn ($location) => $location->location);

        return view('dashboard.map.byDate', [
            'locations' => $locations,
            'app' => $app,
        ]);
    }
}
