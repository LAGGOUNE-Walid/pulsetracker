<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'app_key' => $this->app_key,
            'key' => $this->key,
            'name' => $this->name,
            'type' => $this->deviceType->name,
            'app' => new AppResource($this->app),
            'lastLocation' => new DeviceLastLocationResource($this->lastLocation),
            'quota' => DeviceMonthlyQuotaResource::collection($this->locationsCounts),
        ];
    }
}
