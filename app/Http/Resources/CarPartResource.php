<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarPartResource extends JsonResource
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
            'category_id' => $this->category_id,
            'category_name' => $this->category?->name,
            'category_name_ar' => $this->category?->name_ar,
            'model_id' => $this->model_id,
            'model_name' => $this->model?->name,
            'model_name_ar' => $this->model?->name_ar,
            'store_id' => $this->store_id,
            'store_name' => $this->store?->name,
            'store_name_ar' => $this->store?->name_ar,
            'price' => intval($this->price),
            'creation_country' => $this->creation_country,
            'main_photo' => $this->main_photo ? url($this->main_photo) : null,
        ];    }
}
