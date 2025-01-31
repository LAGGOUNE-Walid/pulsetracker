<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateGeofenceAction;
use App\Actions\UpdateGeofenceAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGeofenceRequest;
use App\Http\Requests\UpdateGeofenceRequest;
use App\Http\Resources\GeofenceResource;
use App\Traits\CreatePolygonFromRequestGeometryTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserGeofencingController extends Controller
{
    use CreatePolygonFromRequestGeometryTrait;

    public function __construct(
        public CreateGeofenceAction $createGeofenceAction,
        public UpdateGeofenceAction $updateGeofenceAction
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $geofences = $request->user()->geofences()->orderByDesc('id');
        if ($request->has('app_id')) {
            $geofences = $geofences->where('app_id', $request->query('app_id'));
        }

        return GeofenceResource::collection($geofences->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGeofenceRequest $request): GeofenceResource
    {
        $polygon = $this->createPolygonFromRequestGeometry($request->geometry);

        if ($polygon === null) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, json_encode([
                'message' => 'The geometry must be valid',
                'errors' => [
                    'geometry' => [
                        'The geometry must be valid',
                    ],
                ],
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
    public function show(Request $request, int $id): GeofenceResource
    {
        return new GeofenceResource($request->user()->geofences()->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGeofenceRequest $request, int $id): Response
    {
        $newPolygon = null;
        if ($request->has('geometry') and $request->geometry !== null and $request->geometry !== '') {
            $newPolygon = $this->createPolygonFromRequestGeometry($request->geometry);
            if ($newPolygon === null) {
                return abort(Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        $newName = null;
        if ($request->has('name') and $request->name !== null and $request->name !== '') {
            $newName = $request->name;
        }
        $this->updateGeofenceAction->update(
            auth()->user()->geofences()->where('id', $id)->firstOrFail(),
            auth()->user()->apps()->where('id', $request->app_id)->firstOrFail(),
            $newPolygon,
            $newName,
            $request->webhook_url
        );

        return response('', Response::HTTP_OK);
    }
}
