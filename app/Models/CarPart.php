<?php

namespace App\Models;

use App\Statuses\ServiceCategoryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CarPart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public function scopeGetCarPartAvailable($query)
    {
        $random = Cache::remember('random_car_parts', 1800, function () {
            return rand(1, 100);
        });

        return $query->join('orders', function ($join) {
            $join->on('orders.store_id', '=', 'car_parts.store_id')
                ->where('orders.start_time', '<=', now())
                ->where(function ($query) {
                    $query->whereNull('orders.end_time')
                        ->orWhere('orders.end_time', '>=', now());
                })
                ->where('orders.active', '=', 1);
        })
            ->join('services', function ($join) {
                $join->on('orders.service_id', '=', 'services.id')
                    ->whereJsonContains('services.services', 'parts');
            })
            ->select(
                'car_parts.*',
                DB::raw("MAX(CASE WHEN services.has_top_result = 1 THEN 1 ELSE 0 END) as is_active_store")
            )
            ->whereNotNull('orders.store_id')
            ->whereIntegerInRaw('services.category_service_id', [ServiceCategoryStatus::SUBSCRIPTION, ServiceCategoryStatus::TOP_RESULT])
            ->groupBy('car_parts.id')
            ->orderByDesc('is_active_store')
            ->orderByRaw('car_parts.id % ?', [$random]);
    }

    public function category()
    {
        return $this->belongsTo(CarPartCategory::class, 'category_id');
    }

    public function model()
    {
        return $this->belongsTo(Model::class , 'model_id' , 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function setMainPhotoAttribute($photo)
    {

        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            // If it's a valid URL, assign it directly
            $this->attributes['main_photo'] = $photo;
        } elseif ($photo instanceof UploadedFile) {
            // If it's an uploaded file, store it
            $newImageName = uniqid().'_'.'main_photo_car_part'.'.'.$photo->extension();
            $photo->move(public_path('asset/carPart'), $newImageName);
            $this->attributes['main_photo'] = '/asset/carPart/'.$newImageName;
        } else {
            // If it's a string (e.g., local path), assign it directly
            $this->attributes['main_photo'] = $photo;
        }




//        if (filter_var($photo, FILTER_VALIDATE_URL)) {
//            // If it's a URL, just assign it
//            $this->attributes['main_photo'] = $photo;
//        } elseif ($photo) {
//            $newImageName = uniqid().'_'.'main_photo_car_part'.'.'.$photo->extension();
//            $photo->move(public_path('asset/carPart'), $newImageName);
//            $this->attributes['main_photo'] = '/asset/carPart/'.$newImageName;
//        }
    }

}
