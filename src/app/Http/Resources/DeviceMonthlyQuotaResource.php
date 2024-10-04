<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceMonthlyQuotaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            /** @var int */
            'year' => $this->year,
            /** @var int */
            'month' => $this->month,
            /** @var int */
            'messages_sent' => $this->messages_sent,
        ];
    }
}
