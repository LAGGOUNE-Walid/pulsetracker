<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Actions\CreateGeofenceAction;
use App\Http\Requests\CreateGeofenceRequest;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\GeofenceResource;
use App\Traits\CreatePolygonFromRequestGeometryTrait;

class UserGeofencingController extends Controller
{

    use CreatePolygonFromRequestGeometryTrait;

    public function __construct(
        public CreateGeofenceAction $createGeofenceAction
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGeofenceRequest $request): GeofenceResource
    {
        $polygon = $this->createPolygonFromRequestGeometry($request->geometry);

        if ($polygon === null) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, json_encode([
                "message" => "The geometry must be valid",
                "errors" => [
                    "geometry" => [
                        "The geometry must be valid"
                    ]
                ]
            ]));
        }

        return new GeofenceResource($this->createGeofenceAction->create(
            auth()->user()->apps()->where('id', $request->app_id)->firstOrFail(),
            $polygon,
            $request->name,
            $request->webhook_url
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
