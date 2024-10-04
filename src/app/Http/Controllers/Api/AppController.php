<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateAppAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppResource;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class AppController extends Controller
{
    public function __construct(
        public CreateAppAction $createAppAction
    ) {}

    /**
     * Get current user apps
     *
     * Get current user created apps paginated by 12 per page
     *
     * @response AnonymousResourceCollection<LengthAwarePaginator<AppResource>>
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return AppResource::collection($request->user()->apps()->with(['locationsCounts' => function ($query) {
            return $query->orderByDesc('id');
        }])->orderByDesc('id')->paginate(12));
    }

    /**
     * Create new user app
     */
    public function store(Request $request): AppResource
    {

        if ($request->user()->cannot('create', App::class)) {
            abort(Response::HTTP_FORBIDDEN, 'You have exceeded your monthly quota. Please upgrade your plan or wait until your quota resets.');
        }

        $request->validate([
            'name' => 'required',
        ]);

        return new AppResource($this->createAppAction->create($request->user(), $request->name));
    }

    /**
     * Get user app by key
     *
     * @param  string  $id  the app key.
     */
    public function show(Request $request, string $id): AppResource
    {
        return new AppResource($request->user()->apps()->where('key', $id)->withCount(['devices'])->firstOrFail());
    }

    /**
     * Update app
     *
     * update the name of the user app
     *
     * @param  string  $id  the app key.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $app = $request->user()->apps()->where('key', $id)->firstOrFail();

        return $app->update(['name' => $request->name]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        return $request->user()->apps()->where('key', $id)->firstOrFail()->delete();
    }
}
