<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transorm the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product->id,
            'store_id' => $this->product->store?->id,
            'store_name' => $this->product->store?->name,
            'store_name_ar' => $this->product->store?->name_ar,
            'name' => $this->product->brand?->name.' '.$this->product->model?->name,
            'name_ar' => $this->product->brand?->name_ar.' '.$this->product->model?->name_ar,
            'offer' => true,
            'old_price' => $this->product->price,
            'price' => $this->final_price,
            'mileage' => $this->product->mileage,
            'main_photo' => url($this->product->main_photo),
            'year_of_construction' => $this->product->year_of_construction,
            'gears' => $this->product->gears,
            'type' => $this->product->type,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,

        ];
    }
}
