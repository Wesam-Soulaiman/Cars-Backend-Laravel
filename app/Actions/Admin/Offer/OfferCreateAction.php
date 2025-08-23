<?php

namespace App\Actions\Admin\Offer;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Store;
use App\Repository\OfferRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class OfferCreateAction
{
    public function __construct(protected OfferRepository $offerRepository) {}

    public function __invoke(OfferRequest $request)
    {
        $store = Auth::guard('store')->user();

        if ($store instanceof Store && ! Product::where('store_id', $store->id)->where('id', $request->product_id)->exists()) {
            throw new AuthorizationException('This action is unauthorized.');
        }
        if ($this->hasOverlappingOffers($request->product_id, $request->start_time, $request->end_time)) {
            return response()->json(['errors' => ['لا يمكن إضافة هذا العرض لأنه يتداخل مع عرض آخر موجود لنفس المنتج']], 422);
        }

        return $this->offerRepository->addOffer($request->validated());

    }

    private function hasOverlappingOffers(int $productId, string $startTime, string $endTime): bool
    {
        return Offer::where('product_id', $productId)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                        ->where('end_time', '>', $startTime);
                });
            })
            ->exists();
    }
}
