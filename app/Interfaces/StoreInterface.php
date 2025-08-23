<?php

namespace App\Interfaces;

use App\Filter\StoreFilter;
use App\Models\Store;

interface StoreInterface
{
    public function addStore($data);

    public function StoreCountAvailable();

    public function searchStore(StoreFilter $filter);

    public function updateStore(Store $store, $data);

    public function deleteStore(Store $store);

    public function showStore(Store $store);

    public function indexStore(StoreFilter $filters);

    public function storeSpecial();
}
