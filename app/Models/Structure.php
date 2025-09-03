<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $guarded = ['id'] ;


    public function setMainPhotoAttribute($photo)
    {
        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            // If it's a URL, just assign it
            $this->attributes['main_photo'] = $photo;
        } elseif ($photo) {
            $newImageName = uniqid().'_'.'main_photo_structure'.'.'.$photo->extension();
            $photo->move(public_path('asset/structure'), $newImageName);
            $this->attributes['main_photo'] = '/asset/structure/'.$newImageName;
        }
    }
}
