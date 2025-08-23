<?php

namespace App\Models;

use App\Models\Model as ModelCar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'name_ar', 'logo'];

    public function setLogoAttribute($photo)
    {
        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            $this->attributes['logo'] = $photo;
        } elseif ($photo) {
            $newImageName = uniqid().'_'.'brand'.'.'.$photo->extension();
            $photo->move(public_path('asset/brand'), $newImageName);
            $this->attributes['logo'] = '/asset/brand/'.$newImageName;
        }
    }

    public function models()
    {
        return $this->hasMany(ModelCar::class);
    }
}
