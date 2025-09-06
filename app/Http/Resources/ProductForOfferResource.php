<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductForOfferResource extends JsonResource
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
            'brand' =>  BrandResource::make($this->brand),
            'store' => StoreResource::make($this->store),
            'model' =>  $this->model,
            'color' =>  $this->color,
            'fuel_type' =>  $this->fuel_type,
            'gear' => $this->gear,
            'light' =>  $this->light,
            'deal' =>  $this->deal,
            'structure' => StructureResource::make($this->structure),
            'main_photo' => $this->main_photo ? url($this->main_photo) : '',
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
            'hex' => $this->hex,
            'features' => FeatureResource::collection($this->features),
            'photos'=>$this->Photos->map(fn ($photo) => ['id' => $photo->id, 'photo' => url($photo->photo)])->all(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
