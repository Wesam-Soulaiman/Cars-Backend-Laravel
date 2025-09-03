<?php

namespace App\Models;

use App\Statuses\ServiceCategoryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Store extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'name_ar', 'address', 'address_ar', 'email', 'password', 'photo', 'phone', 'whatsapp_phone', 'latitude', 'longitude', 'active', 'premium', 'type'];

    protected $hidden = ['password'];

    protected $casts = ['password' => 'hashed'];

    public function setPhotoAttribute($photo)
    {
        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            // If it's a URL, just assign it
            $this->attributes['photo'] = $photo;
        } elseif ($photo) {
            // If it's a file, handle the upload
            $newImageName = uniqid().'_'.'store'.'.'.$photo->extension();
            $photo->move(public_path('asset/store'), $newImageName);
            $this->attributes['photo'] = '/asset/store/'.$newImageName;
        }
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function Countproducts()
    {
        return $this->hasMany(Product::class)->count();
    }

    public function storeTypes()
    {
        return $this->belongsTo(StoreType::class, 'store_type_id', 'id');
    }

    public function governorates()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id', 'id');
    }


    public function scopeWithStoreAvailable($query)
    {
        $random = Cache::remember('random', 1800, function () {
            return rand(1, 100);
        });

        return $query->join('orders', function ($join) {
            $join->on('orders.store_id', '=', 'stores.id')
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
                            ->orWhereJsonContains('services.services', 'rent')
                            ->orWhereJsonContains('services.services', 'parts');
                    });
            })
            ->select(
                'stores.*',
                DB::raw("MAX(CASE WHEN services.has_top_result = 1 THEN 1 ELSE 0 END) as is_active_store")
            )
            ->whereNotNull('orders.store_id')
            ->groupBy('stores.id')
            ->orderByDesc('is_active_store')
            ->orderByRaw('stores.id % ?', [$random]);
    }

    public function scopeWithStoreTopResult($query)
    {
        $random = Cache::remember('random_stores', 1800, function () {
            return rand(1, 100);
        });

        return $query->join('orders', function ($join) {
            $join->on('orders.store_id', '=', 'stores.id')
                ->where('orders.start_time', '<=', now())
                ->where(function ($query) {
                    $query->whereNull('orders.end_time')
                        ->orWhere('orders.end_time', '>=', now());
                })
                ->where('orders.active', '=', 1);
        })
            ->join('services', function ($join) {
                $join->on('orders.service_id', '=', 'services.id')
                    ->where('services.has_top_result', '=', 1);
            })
            ->select(
                'stores.*',
                DB::raw('MAX(CASE WHEN services.has_top_result = 1 THEN 1 ELSE 0 END) as is_active_store')
            )
            ->whereNotNull('orders.store_id')
            ->groupBy('stores.id')
            ->orderByDesc('is_active_store')
            ->orderByRaw('stores.id % ?', [$random])
            ->limit(6);
    }
}
