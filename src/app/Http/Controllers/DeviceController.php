<?php

namespace App\Http\Controllers;

use App\Actions\CreateDeviceAction;
use App\Models\Device;
use App\Models\DeviceType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function __construct(public CreateDeviceAction $createDeviceAction) {}

    public function index(Request $request): View
    {
        return view('dashboard.devices.index');
    }

    public function showCreate(Request $request): View
    {
        return view('dashboard.devices.create', [
            'apps' => $request->user()->apps,
            'deviceTypes' => DeviceType::all(),
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        if ($request->user()->cannot('create', Device::class)) {
            return redirect()->back()->with('error', "You've reached the limit for creating devices on your current plan. Please upgrade to add more devices and unlock additional features.");
        }

        $request->validate([
            'name' => 'required',
            'device_type' => 'required',
            'app_id' => 'required',
        ]);

        $this->createDeviceAction->create(
            $request->name,
            $request->user(),
            $request->user()->apps()->findOrFail($request->app_id),
            DeviceType::find($request->device_type)
        );

        return redirect()->back()->with('success', 'Device successfully created! You can now return to devcies table and start using it with the provided device ID.');
    }

    public function get(string $key, Request $request): View
    {
        $historyLimitsByDay = 0;
        $subscriptions = config('stripe-subscriptions.plans');
        foreach ($subscriptions as $subscription) {
            if ($request->user()->subscribedToPrice($subscription['price_id'], $subscription['product_id'])) {
                $historyLimitsByDay = $subscription['size']['data_retention_days'];
            }
        }
        if ($historyLimitsByDay === 0) {
            $historyLimitsByDay = $subscriptions['free']['size']['data_retention_days'];
        }
        $device = Device::where('key', $key)
            ->with([
                'app',
                'deviceType',
                'locationsCounts',
                'locations' => function ($query) use ($historyLimitsByDay) {
                    return $query
                        ->whereDate('created_at', '>=', now()->subDays($historyLimitsByDay))
                        ->select(DB::raw('DATE(created_at) as date, id, device_id'), DB::raw('count(*) as count'))
                        ->groupBy(DB::raw('DATE(created_at)'))
                        ->orderBy(DB::raw('DATE(created_at)'), 'desc');
                },
            ])
            ->firstOrFail();

        return view('dashboard.devices.show', [
            'device' => $device,
        ]);
    }
}
