<?php

namespace App\Actions\Admin\Store;

use App\Models\Store;
use App\Repository\StoreRepository;

class StoreShowAction
{
    public function __construct(protected StoreRepository $storeRepository) {}

    public function __invoke(Store $store)
    {
        return $this->storeRepository->showStore($store);
    }
}
