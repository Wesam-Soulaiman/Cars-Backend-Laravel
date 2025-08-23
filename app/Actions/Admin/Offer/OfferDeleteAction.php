<?php

namespace App\Actions\Admin\Offer;

use App\Models\Offer;
use App\Models\Product;
use App\Models\Store;
use App\Repository\OfferRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class OfferDeleteAction
{
    public function __construct(protected OfferRepository $offerRepository) {}

    public function __invoke(Offer $offer)
    {
        $store = Auth::guard('store')->user();

        if ($store instanceof Store && ! Product::where('store_id', $store->id)->where('id', $offer->product_id)->exists()) {
            throw new AuthorizationException('This action is unauthorized.');
        }

        return $this->offerRepository->deleteOffer($offer);
    }
}
