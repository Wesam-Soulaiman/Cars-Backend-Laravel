<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'category_service_id' => $this->category_service_id,
            'category_service' => $this->categoryService ? $this->categoryService->name : null,
            'has_top_result' => boolval($this->has_top_result),
            'services' => $this->services,
            'description' => $this->description,
            'description_ar' => $this->description_ar,
            'count_product' => $this->count_product,
            'count_days' => $this->count_days,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
