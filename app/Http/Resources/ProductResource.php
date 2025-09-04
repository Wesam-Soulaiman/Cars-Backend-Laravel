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
//        return [
//            'id' => $this->id,
//            'name' => $this->brand?->name . ' ' . $this->model?->name,
//            'name_ar' => $this->brand?->name_ar . ' ' . $this->model?->name_ar,
//            'store_id' => $this->store?->id,
//            'store_name' => $this->store?->name,
//            'store_name_ar' => $this->store?->name_ar,
//            'old_price' => $this->price ? intval($this->price) : null,
//            'offer' => $this->activeOffer ? true : false,
//            'price' => $this->final_price ? intval($this->final_price) : ($this->price ? intval($this->price) : null),
//            'mileage' => $this->mileage,
//            'main_photo' => $this->main_photo ? url($this->main_photo) : null,
//            'register_year' => $this->register_year,
//            'fuel_type' => $this->fuel_type?->name,
//            'fuel_type_ar' => $this->fuel_type?->name_ar,
//            'year_of_construction' => $this->year_of_construction,
//            'gear' => $this->gear?->name,
//            'gear_ar' => $this->gear?->name_ar,
//            'type' => $this->type,
//        ];
        return [
            'id' => $this->id,
            'name' => $this->brand?->name.' '.$this->model?->name,
            'brand' =>  $this->brand,
//            'store' =>  $this->store,
            'store' => StoreResource::make($this->store),
            'model' =>  $this->model,
            'color' =>  $this->color,
            'fuel_type' => $this->fuel_type,
            'gear' =>  $this->gear,
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
//            'features' => $this->features,
//            'photos' =>  $this->photos,
            'photos'=>$this->Photos->map(fn ($photo) => ['id' => $photo->id, 'photo' => url($photo->photo)])->all(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
