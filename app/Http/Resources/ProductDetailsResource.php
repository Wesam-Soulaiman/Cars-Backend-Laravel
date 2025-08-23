<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
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
            'offerId' => $this->activeOffer?->id,
            'start_time' => $this->activeOffer?->start_time,
            'end_time' => $this->activeOffer?->end_time,
            'brand_id' => $this->brand?->id,
            'brand_name' => $this->brand?->name,
            'brand_name_ar' => $this->brand?->name_ar,
            'model_name' => $this->model?->name,
            'model_name_ar' => $this->model?->name_ar,
            'model_id' => $this->model?->id,
            'store_id' => $this->store?->id,
            'store_name' => $this->store?->name,
            'store_name_ar' => $this->store?->name,
            'store_address' => $this->store?->address,
            'store_address_ar' => $this->store?->address_ar,
            'structure_name' => $this->structure?->name,
            'structure_id' => $this->structure_id,
            'store_phone' => $this->store?->phone,
            'store_whatsapp_phone' => $this->store?->whatsapp_phone,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'price' => $this->final_price ? intval($this->final_price) : 'غير محدد',
            'mileage' => $this->mileage ?? 'غير محدد',
            'main_photo' => url($this->main_photo),
            'photos' => $this->Photos->map(fn ($photo) => ['id' => $photo->id, 'photo' => url($photo->photo)])->all(),
            'year_of_construction' => $this->year_of_construction,
            'register_year' => $this->register_year,
            'gears' => $this->gears,
            'type' => $this->type,
            'number_of_seats' => $this->number_of_seats,
            'drive_type' => $this->drive_type,
            'fuel_type' => $this->fuel_type,
            'cylinders' => $this->cylinders,
            'cylinder_capacity' => $this->cylinder_capacity,
            'seat_type' => $this->seat_type,
            'sunroof' => boolval($this->sunroof),
            'color' => $this->color,
            'lights' => intval($this->lights),
            'features' => FeatureResource::collection($this->features),

        ];
    }
}
