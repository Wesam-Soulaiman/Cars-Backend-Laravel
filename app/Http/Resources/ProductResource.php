<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->brand?->name.' '.$this->model?->name,
            'name_ar' => $this->brand?->name_ar.' '.$this->model?->name_ar,
            'store_id' => $this->store->id,
            'store_name' => $this->store->name,
            'store_name_ar' => $this->store->name_ar,
            'old_price' => intval($this->price),
            'offer' => $this->activeOffer ? true : false,
            'price' => intval($this->final_price),
            'mileage' => $this->mileage,
            'main_photo' => url($this->main_photo),
            'register_year' => $this->register_year,
            'fuel_type' => $this->fuel_type,
            'year_of_construction' => $this->year_of_construction,
            'gears' => $this->gears,
            'type' => $this->type,
        ];
    }
}
