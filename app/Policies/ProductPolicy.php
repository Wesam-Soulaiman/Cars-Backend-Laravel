<?php

namespace App\Policies;

use App\Models\Deal;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the store can create a product.
     *
     * @param Store $store
     * @param array $productData
     * @return bool
     */
    public function create($store, array $productData = []): bool
    {

        if ($store instanceof Employee && $store->role->name == 'admin') {
            return true;
        }
        // Find an active order for the store
        $activeOrder = Order::where('store_id', $store->id)
            ->where('active', true)
            ->where(function ($query) {
                $query->whereNull('end_time')
                    ->orWhere('end_time', '>=', Carbon::now());
            })
            ->with('service')
            ->first();

        if (!$activeOrder) {
            return false; // No active subscription
        }

        $service = $activeOrder->service;

        // Check if the deal type is allowed by the subscription's services
        $dealId = $productData['deal_id'] ?? null;
        if ($dealId) {
            $deal = Deal::find($dealId);
            if (!$deal) {
                return false; // Invalid deal_id
            }

            $allowedServices = $service->services ?? [];
            $dealName = $deal->name;

            // Map deal names to service types
            $requiredService = match ($dealName) {
                'sell' => 'sell',
                'daily rent', 'monthly rent', 'yearly rent' => 'rent',
                default => null,
            };
//            dd($requiredService);

            if ($requiredService ==null || !in_array($requiredService, $allowedServices)) {
                return false; // Deal type not allowed by subscription
            }
        }

        // Check product count limit (for both products and car_parts)
        if ($activeOrder->remaining_count_product !== null && $activeOrder->remaining_count_product <= 0) {
            return false; // No remaining product slots
        }

        return true; // All checks passed
    }


//    public function update(Store $store, Product $product): bool
//    {
//        return $store->id === $product->store_id;
//
//    }

    public function update($store, Product $product, array $productData = []): bool
    {
        if ($store instanceof Employee && $store->role->name == 'admin') {
            return true;
        }
        elseif($store instanceof Store) {

            if ($store->id !== $product->store_id) {
                return false;
            }
            if (isset($productData['deal_id']) && $productData['deal_id'] !== $product->deal_id) {
                $startTime = microtime(true);
                $activeOrder = Order::where('store_id', $store->id)
                    ->where('active', true)
                    ->where(function ($query) {
                        $query->whereNull('end_time')
                            ->orWhere('end_time', '>=', Carbon::now());
                    })
                    ->with('service:id,services')
                    ->first();


                if (!$activeOrder) {
                    return false;
                }

                $service = $activeOrder->service;
                $dealId = $productData['deal_id'];
                $deal = Deal::find($dealId);

                if (!$deal) {
                    return false; // Invalid deal_id
                }

                $allowedServices = $service->services ?? [];
                $dealName = $deal->name;


                $requiredService = match ($dealName) {
                    'sell' => 'sell',
                    'daily rent', 'monthly rent', 'yearly rent' => 'rent',
                    default => null,
                };

                if ($requiredService == null || !in_array($requiredService, $allowedServices)) {
                    return false; // Deal type not allowed by subscription
                }

            }

            return true;
        }
        return false;
    }

    public function delete($store, Product $product): bool
    {

        if ($store instanceof Employee && $store->role->name == 'admin') {
            return true;
        }
        elseif($store instanceof Store) {
            return $store->id === $product->store_id;
        }
        return false;
    }
}
