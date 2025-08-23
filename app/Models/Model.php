<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as M;

class Model extends M
{
    use HasFactory;

    protected $fillable = ['brand_id', 'name', 'name_ar'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
