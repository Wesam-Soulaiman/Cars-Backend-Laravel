<?php

namespace App\Actions\Admin\Store;

use App\Http\Requests\FilterStoreRequest;
use App\Repository\StoreRepository;

class GetFilterStoreAction
{
    public function __construct(protected StoreRepository $storeRepository) {}

    public function __invoke(FilterStoreRequest $request)
    {
        return $this->storeRepository->getColStore($request->toFilter());
    }
}
