<?php

namespace App\Actions\Admin\StoreType;

use App\Http\Requests\StoreTypeRequest;
use App\Repository\StoreTypeRepository;

class StoreTypeCreateAction
{
    public function __construct(protected StoreTypeRepository $storeTypeRepository) {}

    public function __invoke(StoreTypeRequest $request)
    {
        return $this->storeTypeRepository->addStoreType($request->validated());
    }
}
