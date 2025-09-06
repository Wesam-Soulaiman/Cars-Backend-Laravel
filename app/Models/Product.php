<?php

namespace App\Models;

use App\Statuses\ServiceCategoryStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

//    public function setMainPhotoAttribute($photo)
//    {
//        if (filter_var($photo, FILTER_VALIDATE_URL)) {
//            // If it's a URL, just assign it
//            $this->attributes['main_photo'] = $photo;
//        } elseif ($photo) {
//            $newImageName = uniqid().'_'.'main_photo_product'.'.'.$photo->extension();
//            $photo->move(public_path('asset/product'), $newImageName);
//            $this->attributes['main_photo'] = '/asset/product/'.$newImageName;
//        }
//    }

    public function setMainPhotoAttribute($photo)
    {
//        if (is_null($photo)) {
//            $this->attributes['main_photo'] = null;
//            return;
//        }

        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            // If it's a valid URL, assign it directly
            $this->attributes['main_photo'] = $photo;
        } elseif ($photo instanceof UploadedFile) {
            // If it's an uploaded file, store it
            $newImageName = uniqid() . '_' . 'main_photo_product' . '.' . $photo->extension();
            $photo->move(public_path('asset/product'), $newImageName);
            $this->attributes['main_photo'] = '/asset/product/' . $newImageName;
        } else {
            // If it's a string (e.g., local path), assign it directly
            $this->attributes['main_photo'] = $photo;
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

    public function fuel_type()
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

    public function offer()
    {
        return $this->hasMany(Offer::class );
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
                    ->where(function ($query) {
                        $query->whereNull('orders.end_time')
                            ->orWhere('orders.end_time', '>=', now());
                    })
                    ->where('orders.active', '=', 1);
            })
            ->join('services', function ($join) {
                $join->on('orders.service_id', '=', 'services.id')
                    ->where(function ($query) {
                        $query->whereJsonContains('services.services', 'sell')
                            ->orWhereJsonContains('services.services', 'rent');
                    });
            })
            ->select(
                'products.*',
                DB::raw('COALESCE(offers.final_price, products.price) as final_price'),
                DB::raw("MAX(CASE WHEN services.has_top_result = 1 THEN 1 ELSE 0 END) as is_active_store")
            )
            ->whereNotNull('orders.store_id')
            ->whereIntegerInRaw('services.category_service_id', [ServiceCategoryStatus::SUBSCRIPTION, ServiceCategoryStatus::TOP_RESULT])
            ->groupBy('products.id')
            ->orderByDesc('is_active_store')
            ->orderByRaw('products.id % ?', [$random]);
    }


    public function scopeGetProductTopResult($query)
    {
        $random = Cache::remember('random_products_top', 1800, function () {
            return rand(1, 100);
        });

        return $query->leftJoin('offers', function ($join) {
            $join->on('products.id', '=', 'offers.product_id')
                ->where('offers.start_time', '<=', now())
                ->where('offers.end_time', '>=', now());
        })
            ->join('orders', function ($join) {
                $join->on('orders.store_id', '=', 'products.store_id')
                    ->where('orders.start_time', '<=', now())
                    ->where(function ($query) {
                        $query->whereNull('orders.end_time')
                            ->orWhere('orders.end_time', '>=', now());
                    })
                    ->where('orders.active', '=', 1);
            })
            ->join('services', function ($join) {
                $join->on('orders.service_id', '=', 'services.id')
                    ->where('services.has_top_result', '=', 1)
                    ->where(function ($query) {
                        $query->whereJsonContains('services.services', 'sell')
                            ->orWhereJsonContains('services.services', 'rent');
                    });
            })
            ->select(
                'products.*',
                DB::raw('COALESCE(offers.final_price, products.price) as final_price'),
                DB::raw('MAX(CASE WHEN services.has_top_result = 1 THEN 1 ELSE 0 END) as is_active_store')
            )
            ->whereNotNull('orders.store_id')
            ->groupBy('products.id')
            ->orderByDesc('is_active_store')
            ->orderByRaw('products.id % ?', [$random]);
    }

    public function scopeFilterMinPrice($query, $minPrice)
    {
        return $query->having('final_price', '>=', $minPrice);
    }

    public function scopeFilterMaxPrice($query, $maxPrice)
    {
        return $query->having('final_price', '<=', $maxPrice);
    }
    public function finalPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->activeOffer?->final_price ?? $this->price,
        );
    }
}
