<?php


namespace App\Actions\Website\SearchStore;

use App\Models\Store;
use App\Repository\StoreRepository;

class StoreProductAction
{
    public function __construct(protected StoreRepository $storeRepository) {}

    public function __invoke(Store $store)
    {
        return $this->storeRepository->getStoreProduct($store);
    }
}
