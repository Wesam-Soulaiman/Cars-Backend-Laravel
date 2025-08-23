<?php

namespace App\Actions\Website\SearchStore;

use App\Http\Requests\SearchStoreRequest;
use App\Repository\StoreRepository;

class StoreSearchAction
{
    public function __construct(protected StoreRepository $storeRepository) {}

    public function __invoke(SearchStoreRequest $searchStoreRequest)
    {
        return $this->storeRepository->searchStore($searchStoreRequest->toFilter());
    }
}
