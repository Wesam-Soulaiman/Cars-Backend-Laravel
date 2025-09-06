<?php

namespace App\Models;

use App\Statuses\ServiceCategoryStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['final_price', 'start_time', 'end_time', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class)->with(['store', 'model', 'brand']);
    }

//    public function scopeActiveOffer($query)
//    {
//        return $query->leftJoin('products', 'offers.product_id', '=', 'products.id')
//            ->leftJoin('orders', function ($join) {
//                $join->on('orders.store_id', '=', 'products.store_id')
//                    ->whereDate('orders.start_time', '<=', now())
//                    ->whereDate('orders.end_time', '>=', now())
//                    ->whereIn('orders.category_service_id', [ServiceCategoryStatus::SUBSCRIPTION, ServiceCategoryStatus::TOP_RESULT]);
//            })->select('offers.*', 'products.store_id',
//                DB::raw("MAX(CASE WHEN orders.store_id IS NOT NULL AND orders.category_service_id = '".ServiceCategoryStatus::TOP_RESULT."' THEN 1 ELSE 0 END) as is_active_offer")
//            )->whereNotNull('orders.store_id')
//            ->groupBy('products.id')
//            ->whereDate('offers.start_time', '<=', now())
//            ->whereDate('offers.end_time', '>=', now())
//            ->orderByDesc('is_active_offer')
//            ->orderBy('offers.id');
//    }

    public function scopeActiveOffer($query)
    {
//        Log::debug('Offer::scopeActiveOffer started', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);

        $query = $query->whereDate('offers.start_time', '<=', now())
            ->whereDate('offers.end_time', '>=', now())
            ->leftJoin('products', 'offers.product_id', '=', 'products.id')
            ->leftJoin('orders', function ($join) {
                $join->on('orders.store_id', '=', 'products.store_id')
                    ->whereDate('orders.start_time', '<=', now())
                    ->whereDate('orders.end_time', '>=', now())
                    ->where('orders.active', true)
                    ->whereExists(function ($subQuery) {
                        $subQuery->select(DB::raw(1))
                            ->from('services')
                            ->join('category_services', 'services.category_service_id', '=', 'category_services.id')
                            ->whereColumn('services.id', 'orders.service_id');
//                            ->where('category_services.name', 'subscription');
                    });
            })
            ->select('offers.*')
            ->whereNotNull('orders.store_id')
            ->distinct();

//        Log::debug('Offer::scopeActiveOffer completed', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);

        return $query;
    }

    public function scopeForStore(Builder $query, $storeId = null)
    {
        if ($storeId) {
            return $query->whereHas('product', function ($q) use ($storeId) {
                $q->where('store_id', $storeId);
            });
        }

        return $query;
    }
}
