<?php

namespace App\Actions\Admin\Store;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Repository\StoreRepository;

class StoreUpdateAction
{
    public function __construct(protected StoreRepository $storeRepository) {}

    public function __invoke(Store $store, StoreRequest $request)
    {
        return $this->storeRepository->updateStore($store, $request->validated());
    }
}
