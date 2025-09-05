<?php

namespace App\Actions\Website\SearchStore;

use App\Http\Requests\SearchStoreRequest;
use App\Repository\StoreRepository;

class StoreSearchAction
{
    public function __construct(protected StoreRepository $storeRepository) {}

    public function __invoke(SearchStoreRequest $request)
    {
        return $this->storeRepository->searchStore($request->toFilter());
    }
}
