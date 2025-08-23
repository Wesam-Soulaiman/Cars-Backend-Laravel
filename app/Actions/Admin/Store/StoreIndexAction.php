<?php

namespace App\Actions\Admin\Store;

use App\Http\Requests\SearchStoreRequest;
use App\Repository\StoreRepository;

class StoreIndexAction
{
    public function __construct(protected StoreRepository $storeRepository) {}

    public function __invoke(SearchStoreRequest $request)
    {
        return $this->storeRepository->indexStore($request->toFilter());
    }
}
