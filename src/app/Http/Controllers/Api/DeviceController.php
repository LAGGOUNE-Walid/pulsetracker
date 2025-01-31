<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateDeviceAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use App\Models\DeviceType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class DeviceController extends Controller
{
    public function __construct(
        public CreateDeviceAction $createDeviceAction
    ) {}

    /**
     * List all user devices
     *
     * List all user created devices or by passing string appKey parameter to the request
     *
     * @response AnonymousResourceCollection<LengthAwarePaginator<DeviceResource>>
     */
    public function index(Request $request)
    {
        $devices = $request->user()->devices()->with([
            'deviceType',
            'app' => function ($query) {
                return $query->withCount('devices');
            },
            'lastLocation',
            'locationsCounts',
        ])->orderByDesc('id');

        /**
         * User app key default is null
         *
         * @default NULL
         */
        $appKey = $request->query('appKey', '');

        if ($appKey !== '') {
            $devices = $devices->where('app_key', $appKey);
        }

        return DeviceResource::collection($devices->paginate(12));
    }

    /**
     * Create new user device
     */
    public function store(Request $request): DeviceResource
    {
        if ($request->user()->cannot('create', Device::class)) {
            abort(Response::HTTP_FORBIDDEN, 'You have exceeded your monthly quota. Please upgrade your plan or wait until your quota resets.');
        }
        $request->validate([
            'name' => 'required',
            'app_key' => 'required|exists:apps,key',
            'type_id' => 'required|exists:device_types,id',
        ]);

        return new DeviceResource($this->createDeviceAction->create(
            $request->name,
            $request->user(),
            $request->user()->apps()->where('key', $request->app_key)->firstOrFail(),
            DeviceType::findOrFail($request->type_id)
        ));
    }

    /**
     * Get user device
     *
     * @param  string  $id  the device key
     */
    public function show(Request $request, string $id): DeviceResource
    {
        return new DeviceResource(
            $request->user()->devices()->where('key', $id)->with(['locationsCounts', 'lastLocation'])->firstOrFail()
        );
    }

    /**
     * Update device
     *
     * Update the name of the user device
     *
     * @param  string  $id  the device key
     */
    public function update(Request $request, string $id): int
    {
        $request->validate([
            'name' => 'required',
        ]);

        return $request->user()->devices()->where('key', $id)->firstOrFail()->update([
            'name' => $request->name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id): int
    {
        return $request->user()->devices()->where('key', $id)->firstOrFail()->delete();
    }
}
