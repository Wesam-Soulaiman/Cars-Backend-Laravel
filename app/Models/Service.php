<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'description_ar',
        'category_service_id',
        'active',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryService::class, 'category_service_id', 'id');
    }
}
