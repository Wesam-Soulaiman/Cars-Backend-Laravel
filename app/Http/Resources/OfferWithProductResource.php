<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferWithProductResource extends JsonResource
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
            'product' => ProductForOfferResource::make($this->product),
            'store_id' => StoreResource::make($this->product->store),
            'name' => $this->product->brand?->name.' '.$this->product->model?->name,
            'name_ar' => $this->product->brand?->name_ar.' '.$this->product->model?->name_ar,
            'offer' => true,
            'old_price' => $this->product->price,
            'price' => $this->final_price,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ];
    }
}
