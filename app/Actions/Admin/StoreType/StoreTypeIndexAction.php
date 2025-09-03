<?php

namespace App\Actions\Admin\StoreType;

use App\Http\Requests\SearchStoreTypeRequest;
use App\Repository\StoreTypeRepository;

class StoreTypeIndexAction
{
    public function __construct(protected StoreTypeRepository $storeTypeRepository) {}

    public function __invoke(SearchStoreTypeRequest $request)
    {
        return $this->storeTypeRepository->indexStoreType($request->toFilter());
    }
}
