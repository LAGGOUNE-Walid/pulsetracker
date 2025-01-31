<?php

namespace App\Http\Controllers;

use App\Actions\CreateGeofenceAction;
use App\Actions\UpdateGeofenceAction;
use App\Http\Requests\CreateGeofenceRequest;
use App\Http\Requests\UpdateGeofenceRequest;
use App\Models\Geofence;
use App\Traits\CreatePolygonFromRequestGeometryTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GeofencingController extends Controller
{
    use CreatePolygonFromRequestGeometryTrait;

    public function __construct(
        public CreateGeofenceAction $createGeofenceAction,
        public UpdateGeofenceAction $updateGeofenceAction
    ) {}

    public function show(Request $request): View
    {
        return view('dashboard.geofencing.index');
    }

    public function get(Geofence $geofence): View
    {
        return view('dashboard.geofencing.show', [
            'apps' => auth()->user()->apps()->orderByDesc('id')->get(),
            'geofence' => $geofence,
        ]);
    }

    public function create(CreateGeofenceRequest $request): RedirectResponse
    {
        $polygon = $this->createPolygonFromRequestGeometry($request->geometry);

        if ($polygon === null) {
            return redirect()->back()->withErrors('Geometry must be valid')->withInput();
        }

        $this->createGeofenceAction->create(
            auth()->user()->apps()->where('id', $request->app_id)->firstOrFail(),
            $polygon,
            $request->name,
            $request->webhook_url
        );

        return redirect('dashboard/geofencing/');
    }

    public function update(UpdateGeofenceRequest $request)
    {
        $newPolygon = null;
        if ($request->has('geometry') and $request->geometry !== null and $request->geometry !== '') {
            $newPolygon = $this->createPolygonFromRequestGeometry($request->geometry);
            if ($newPolygon === null) {
                return redirect()->back()->withErrors('Geometry must be valid')->withInput();
            }
        }

        $newName = null;
        if ($request->has('name') and $request->name !== null and $request->name !== '') {
            $newName = $request->name;
        }

        $this->updateGeofenceAction->update(
            auth()->user()->geofences()->where('id', $request->id)->firstOrFail(),
            auth()->user()->apps()->where('id', $request->app_id)->firstOrFail(),
            $newPolygon,
            $newName,
            $request->webhook_url
        );

        return redirect('dashboard/geofencing/');
    }
}
