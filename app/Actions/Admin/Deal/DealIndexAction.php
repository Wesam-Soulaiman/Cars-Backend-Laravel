<?php

namespace App\Actions\Admin\Deal;

use App\Http\Requests\SearchDealRequest;
use App\Repository\DealRepository;

class DealIndexAction
{
    public function __construct(protected DealRepository $dealRepository) {}

    public function __invoke(SearchDealRequest $request)
    {
        return $this->dealRepository->indexDeal($request->toFilter());
    }
}
