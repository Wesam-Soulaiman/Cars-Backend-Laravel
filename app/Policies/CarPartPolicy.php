<?php

namespace App\Policies;

use App\Models\CarPart;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CarPartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the store can create a car part.
     *
     * @param Store $store
     * @return bool
     */
    public function create($store)
    {

        if ($store instanceof Employee && $store->role->name == 'admin') {
            return true;
        }
//        dd($store);

        $activeOrder = Order::where('store_id', $store->id)
            ->where('active', true)
            ->where(function ($query) {
                $query->whereNull('end_time')
                    ->orWhere('end_time', '>=', Carbon::now());
            })
            ->with('service')
            ->first();
//        dd($activeOrder);


        if (!$activeOrder) {
            return false;
        }

        $service = $activeOrder->service;


        $allowedServices = $service->services ?? [];
        if (!in_array('parts', $allowedServices)) {
            return false; // Parts not allowed by subscription
        }

        if ($activeOrder->remaining_count_product !== null && $activeOrder->remaining_count_product <= 0) {
            return false;
        }

        return true; // All checks passed
    }


    public function update($store, CarPart $product): bool
    {

        if ($store instanceof Employee && $store->role->name == 'admin') {
            return true;
        }

        if ($store instanceof Employee && $store->role()->name == 'admin') {
            return true;
        }elseif($store instanceof Store){
            $activeOrder = Order::where('store_id', $store->id)
                ->where('active', true)
                ->where(function ($query) {
                    $query->whereNull('end_time')
                        ->orWhere('end_time', '>=', Carbon::now());
                })
                ->with('service')
                ->first();
//        dd($activeOrder);


            if (!$activeOrder) {
                return false; // No active subscription
            }

            $service = $activeOrder->service;

            // Check if 'parts' is allowed by the subscription
            $allowedServices = $service->services ?? [];
            if (!in_array('parts', $allowedServices)) {
                return false; // Parts not allowed by subscription
            }

            if ($activeOrder->remaining_count_product !== null && $activeOrder->remaining_count_product <= 0) {
                return false;
            }

            return $store->id === $product->store_id;
        }
        return false;
    }

    public function delete($store, CarPart $product): bool
    {
        if ($store instanceof Employee && $store->role->name == 'admin') {
            return true;
        }
//        if (Auth::guard('admin')->check()) {
//            return true;
//        }
        if($store instanceof Store) {
            return $store->id === $product->store_id;
        }
        return false;
    }
}
