<?php

namespace App\Actions\Admin\Store;

use App\Http\Requests\StoreRequest;
use App\Repository\StoreRepository;

class StoreCreateAction
{
    public function __construct(protected StoreRepository $storeRepository) {}

    public function __invoke(StoreRequest $request)
    {
        return $this->storeRepository->addStore($request->validated());
    }
}
