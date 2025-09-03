<?php

namespace App\Actions\Admin\StoreType;

use App\Http\Requests\StoreTypeRequest;
use App\Models\StoreType;
use App\Repository\StoreTypeRepository;

class StoreTypeUpdateAction
{
    public function __construct(protected StoreTypeRepository $storeTypeRepository) {}

    public function __invoke(StoreType $storeType, StoreTypeRequest $storeTypeRequest)
    {
        return $this->storeTypeRepository->updateStoreType($storeType, $storeTypeRequest->validated());
    }
}
