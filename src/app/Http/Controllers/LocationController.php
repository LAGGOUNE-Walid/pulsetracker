<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class LocationController extends Controller
{
    public function getByDate(string $key, string $date): View
    {
        $locations = Device::where('key', $key)->firstOrFail()->locations()->whereDate('created_at', $date)->get()->map(fn($location) => $location->location);
        // dd($locations->count());
        return view('dashboard.map.byDate', [
            'locations' => $locations
        ]);
    }
}
