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
//        return [
//            'id' => $this->id,
//            'offer_id' => $this->activeOffer?->id,
//            'start_time' => $this->activeOffer?->start_time,
//            'end_time' => $this->activeOffer?->end_time,
//            'brand_id' => $this->brand?->id,
//            'brand_name' => $this->brand?->name,
//            'brand_name_ar' => $this->brand?->name_ar,
//            'model_id' => $this->model?->id,
//            'model_name' => $this->model?->name,
//            'model_name_ar' => $this->model?->name_ar,
//            'store_id' => $this->store?->id,
//            'store_name' => $this->store?->name,
//            'store_name_ar' => $this->store?->name_ar,
//            'store_address' => $this->store?->address,
//            'store_address_ar' => $this->store?->address_ar,
//            'store_phone' => $this->store?->phone,
//            'store_whatsapp_phone' => $this->store?->whatsapp_phone,
//            'structure_id' => $this->structure_id,
//            'structure_name' => $this->structure?->name,
//            'structure_name_ar' => $this->structure?->name_ar,
//            'name' => $this->brand?->name . ' ' . $this->model?->name,
//            'name_ar' => $this->brand?->name_ar . ' ' . $this->model?->name_ar,
//            'price' => $this->final_price ? intval($this->final_price) : ($this->price ? intval($this->price) : 'غير محدد'),
//            'mileage' => $this->mileage ?? 'غير محدد',
//            'main_photo' => $this->main_photo ? url($this->main_photo) : null,
//            'photos' => $this->photos ? $this->photos->map(fn ($photo) => ['id' => $photo->id, 'photo' => url($photo->photo)])->all() : [],
//            'year_of_construction' => $this->year_of_construction,
//            'register_year' => $this->register_year,
//            'deal_id' => $this->deal_id,
//            'deal_name' => $this->deal?->name,
//            'deal_name_ar' => $this->deal?->name_ar,
//            'number_of_seats' => $this->number_of_seats,
//            'drive_type' => $this->drive_type,
//            'fuel_type_id' => $this->fuel_type_id,
//            'fuel_type' => $this->fuel_type?->name,
//            'fuel_type_ar' => $this->fuel_type?->name_ar,
//            'gear_id' => $this->gear_id,
//            'gear' => $this->gear?->name,
//            'gear_ar' => $this->gear?->name_ar,
//            'light_id' => $this->light_id,
//            'light' => $this->light?->name,
//            'light_ar' => $this->light?->name_ar,
//            'color_id' => $this->color_id,
//            'color' => $this->color?->name,
//            'color_ar' => $this->color?->name_ar,
//            'cylinders' => $this->cylinders,
//            'cylinder_capacity' => $this->cylinder_capacity,
//            'type' => $this->type,
//            'sunroof' => boolval($this->sunroof),
//            'additional_features' => $this->additional_features,
//            'features' => FeatureResource::collection($this->features),
//        ];

        return [
            'id' => $this->id,
            'brand' =>  $this->brand,
            'store' =>  $this->store,
            'model' =>  $this->model,
            'color' =>  $this->color,
            'fuel_type' =>  $this->fuelType,
            'gear' => $this->gear,
            'light' =>  $this->light,
            'deal' =>  $this->deal,
            'structure_id' => $this->structure_id,
            'main_photo' => $this->main_photo ? url($this->main_photo) : null,
            'price' => $this->price,
            'mileage' => $this->mileage,
            'year_of_construction' => $this->year_of_construction,
            'register_year' => $this->register_year,
            'number_of_seats' => $this->number_of_seats,
            'drive_type' => $this->drive_type,
            'cylinders' => $this->cylinders,
            'cylinder_capacity' => $this->cylinder_capacity,
            'creation_country' => $this->creation_country,
            'used' => $this->used,
            'sunroof' => $this->sunroof,
            'features' => FeatureResource::collection($this->features),
//            'features' =>  $this->features,
//            'photos' => $this->whenLoaded('photos', fn () => $this->photos),
//            'photos' => $this->photos ? $this->photos->map(fn ($photo) => ['id' => $photo->id, 'photo' => url($photo->photo)])->all() : [],
            'photos'=>$this->Photos->map(fn ($photo) => ['id' => $photo->id, 'photo' => url($photo->photo)])->all(),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
