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

    public function scopeWithStoreAvailable($query)
    {
        $random = Cache::remember('random', 1800, function () {
            return rand(1, 100);
        });

        return $query->leftJoin('orders', function ($join) {
            $join->on('orders.store_id', '=', 'stores.id')
                ->where('orders.start_time', '<=', now())
                ->where('orders.end_time', '>=', now())
                ->where('orders.active', '=', 1)
                ->whereIntegerInRaw('orders.category_service_id', [
                    ServiceCategoryStatus::TOP_RESULT,
                    ServiceCategoryStatus::SUBSCRIPTION,
                ]);
        })
            ->select(
                'stores.*',
                DB::raw("MAX(CASE WHEN orders.store_id IS NOT NULL AND orders.category_service_id = '".ServiceCategoryStatus::TOP_RESULT."' THEN 1 ELSE 0 END) as is_active_store")
            )
            ->whereNotNull('orders.store_id')
            ->groupBy('stores.id')
            ->orderByDesc('is_active_store')
            ->orderByRaw('stores.id % ?', [$random]);
    }

    public function scopeWithStoreTopResult($query)
    {
        return $query->leftJoin('orders', function ($join) {
            $join->on('orders.store_id', '=', 'stores.id')
                ->whereDate('orders.start_time', '<=', now())
                ->whereDate('orders.end_time', '>=', now())
                ->whereIn('orders.category_service_id', [ServiceCategoryStatus::TOP_RESULT]);
        })->select('stores.*', DB::raw('
                 CASE WHEN orders.store_id IS NOT NULL AND orders.category_service_id = "'.ServiceCategoryStatus::TOP_RESULT.'" THEN 1
                 ELSE 0
            END as is_active_store
        '))->whereNotNull('orders.store_id')->inRandomOrder()
            ->limit(6);
    }
}
