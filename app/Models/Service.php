<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];
    protected $casts = ['services' => 'array', 'has_top_result' => 'boolean'];
    public function category()
    {
        return $this->belongsTo(CategoryService::class, 'category_service_id', 'id');
    }
}
