<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['photo', 'photo_ar', 'active'];

    public function setPhotoAttribute($photo)
    {
        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            $this->attributes['photo'] = $photo;
        } elseif ($photo) {
            $newImageName = uniqid().'_'.'photo_banner'.'.'.$photo->extension();
            $photo->move(public_path('asset/banner'), $newImageName);
            $this->attributes['photo'] = '/asset/banner/'.$newImageName;
        }
    }

    public function setPhotoArAttribute($photo)
    {
        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            $this->attributes['photo_ar'] = $photo;
        } elseif ($photo) {
            $newImageName = uniqid().'_'.'photo_ar_banner'.'.'.$photo->extension();
            $photo->move(public_path('asset/banner'), $newImageName);
            $this->attributes['photo_ar'] = '/asset/banner/'.$newImageName;
        }
    }
}
