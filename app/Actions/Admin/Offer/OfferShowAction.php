<?php

namespace App\Actions\Admin\Offer;

use App\Models\Offer;
use App\Repository\OfferRepository;

class OfferShowAction
{
    public function __construct(protected OfferRepository $offerRepository) {}

    public function __invoke(Offer $offer)
    {
        return $this->offerRepository->showOffer($offer);
    }
}
