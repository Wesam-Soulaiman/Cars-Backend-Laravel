<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'service_id' => $this->service?->id,
            'service_name' => $this->service?->name,
            'service_name_ar' => $this->service?->name_ar,
            'store_id' => $this->store?->id,
            'store_name' => $this->store?->name,
            'store_name_ar' => $this->store?->name_ar,
            'price' => $this->price,
            'count_days' => $this->count_days,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'day_left' => Carbon::parse($this->end_time)->isFuture() ? Carbon::parse($this->end_time)->diffInDays(Carbon::now()) : 0,
            'active' => boolval($this->real_active),
            'created_at' => $this->created_at->toDateString(),

        ];
    }
}
