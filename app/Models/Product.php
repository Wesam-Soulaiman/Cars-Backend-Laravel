<?php

namespace App\Models;

use App\Statuses\ServiceCategoryStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function setMainPhotoAttribute($photo)
    {
        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            // If it's a URL, just assign it
            $this->attributes['main_photo'] = $photo;
        } elseif ($photo) {
            $newImageName = uniqid().'_'.'main_photo_product'.'.'.$photo->extension();
            $photo->move(public_path('asset/product'), $newImageName);
            $this->attributes['main_photo'] = '/asset/product/'.$newImageName;
        }
    }

    public function Photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function model()
    {
        return $this->belongsTo(\App\Models\Model::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'product_features');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }


    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function gear()
    {
        return $this->belongsTo(Gear::class);
    }

    public function light()
    {
        return $this->belongsTo(Light::class);
    }

    public function activeOffer()
    {
        return $this->hasOne(Offer::class)
            ->whereDate('start_time', '<=', now())
            ->whereDate('end_time', '>=', now());
    }

    public function scopeGetProductAvailable($query)
    {
        $random = Cache::remember('random', 1800, function () {
            return rand(1, 100);
        });

        return $query->leftJoin('offers', function ($join) {
            $join->on('products.id', '=', 'offers.product_id')
                ->where('offers.start_time', '<=', now())
                ->where('offers.end_time', '>=', now());
        })
            ->leftJoin('orders', function ($join) {
                $join->on('orders.store_id', '=', 'products.store_id')
                    ->where('orders.start_time', '<=', now())
                    ->where('orders.end_time', '>=', now())
                    ->where('orders.active', '=', 1)
                    ->whereIntegerInRaw('orders.category_service_id', [ServiceCategoryStatus::SUBSCRIPTION, ServiceCategoryStatus::TOP_RESULT]);
            })
            ->select(
                'products.*',
                DB::raw('COALESCE(offers.final_price, products.price) as final_price'),
                DB::raw("MAX(CASE WHEN orders.store_id IS NOT NULL AND orders.category_service_id = '".ServiceCategoryStatus::TOP_RESULT."' THEN 1 ELSE 0 END) as is_active_store")
            )
            ->whereNotNull('orders.store_id')
            ->groupBy('products.id')
            ->orderByDesc('is_active_store')
            ->orderByRaw('products.id % ?', [$random]);
    }

    public function scopeGetProductTopResult($query)
    {
        return $query->leftJoin('offers', function ($join) {
            $join->on('products.id', '=', 'offers.product_id')
                ->whereDate('offers.start_time', '<=', now())
                ->whereDate('offers.end_time', '>=', now());
        })
            ->leftJoin('orders', function ($join) {
                $join->on('orders.store_id', '=', 'products.store_id')
                    ->whereDate('orders.start_time', '<=', now())
                    ->whereDate('orders.end_time', '>=', now())
                    ->whereIn('orders.category_service_id', [ServiceCategoryStatus::TOP_RESULT]);
            })
            ->select(
                'products.*',
                DB::raw('COALESCE(offers.final_price, products.price) as final_price'),
                DB::raw('
                CASE
             WHEN orders.store_id IS NOT NULL AND orders.category_service_id = "'.ServiceCategoryStatus::TOP_RESULT.'" THEN 1
                    ELSE 0
                END as is_active_store
            ')
            )
            ->whereNotNull('orders.store_id')->inRandomOrder();
    }

    public function scopeFilterMaxPrice($query, $maxPrice)
    {
        $query->having('final_price', '<=', $maxPrice);

    }

    public function scopeFilterMinPrice($query, $minPrice)
    {

        $query->having('final_price', '>=', $minPrice);

    }

    public function finalPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->activeOffer?->final_price ?? $this->price,
        );
    }
}
