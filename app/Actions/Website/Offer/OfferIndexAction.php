<?php

namespace App\Actions\Website\Offer;

use App\Repository\OfferRepository;
use Illuminate\Http\Request;

class OfferIndexAction
{
    public function __construct(protected OfferRepository $offerRepository) {}

    public function __invoke(Request $request)
    {
        return $this->offerRepository->activeOffer($request->page, $request->per_page);
    }
}
