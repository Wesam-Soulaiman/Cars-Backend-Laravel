<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'role_id' => $this->role?->id,
            'role_name' => $this->role?->name,
            'role_name_ar' => $this->role?->name_ar,

        ];
    }
}
