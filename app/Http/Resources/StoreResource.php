<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'address' => $this->address,
            'address_ar' => $this->address_ar,
            'email' => $this->email,
            'whatsapp_phone' => $this->whatsapp_phone,
            'phone' => $this->phone,
            'photo' => url($this->photo),
            'count_products' => $this->Countproducts(),
            'store_type'=>$this->storeType,
            'governorate'=>$this->governorate,
        ];
    }
}
