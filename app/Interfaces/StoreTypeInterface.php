<?php

namespace App\Interfaces;

use App\Filter\StoreTypeFilter;
use App\Models\StoreType;

interface StoreTypeInterface
{
    public function addStoreType($data);

    public function updateStoreType(StoreType $storeType, $data);

    public function deleteStoreType(StoreType $storeType);

    public function showStoreType(StoreType $storeType);

    public function indexStoreType(StoreTypeFilter $filters);

    public function allStoreType();
}
