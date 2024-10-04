<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {

        return [
            'key' => $this->key,
            'name' => $this->name,
            'quota' => AppMonthlyQuotaResource::collection($this->locationsCounts),
            /* @var int */
            'devices_count' => $this->devices_count,
            'created_at' => $this->created_at,
        ];

    }
}
