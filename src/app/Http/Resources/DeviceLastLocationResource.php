<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceLastLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ip_address' => $this->ip_address,
            /** @var array{type: string, coordinates: array{lat: float, long: float}} */
            'location' => $this->location,
            /** @var array<string, string> */
            'extra_data' => $this->extra_data,
            'updated_at' => $this->created_at,
        ];
    }
}
