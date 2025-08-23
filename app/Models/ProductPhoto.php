<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'photo'];

    public function setPhotoAttribute($photo)
    {
        if ($photo) {
            $newImageName = uniqid().'_'.'photo_product'.'.'.$photo->extension();
            $photo->move(public_path('asset/product'), $newImageName);
            $this->attributes['photo'] = '/asset/product/'.$newImageName;
        }
    }
}
