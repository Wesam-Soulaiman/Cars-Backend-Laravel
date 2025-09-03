<?php

namespace App\Actions\Admin\StoreType;

use App\Models\StoreType;
use App\Repository\StoreTypeRepository;

class StoreTypeDestroyAction
{
    public function __construct(protected StoreTypeRepository $storeTypeRepository) {}

    public function __invoke(StoreType $storeType)
    {
        return $this->storeTypeRepository->deleteStoreType($storeType);
    }
}
