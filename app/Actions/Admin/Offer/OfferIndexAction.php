<?php

namespace App\Actions\Admin\Offer;

use App\Http\Requests\PaginationRequest;
use App\Repository\OfferRepository;

class OfferIndexAction
{
    public function __construct(protected OfferRepository $offerRepository) {}

    public function __invoke(PaginationRequest $request)
    {
        return $this->offerRepository->indexOffer($request->toFilter());
    }
}
