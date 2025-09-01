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
            'category' => $this->category,
            'model' => $this->model,
            'store' => $this->store,
            'price' => intval($this->price),
            'creation_country' => $this->creation_country,
            'main_photo' => $this->main_photo ? url($this->main_photo) : null,
        ];    }
}
