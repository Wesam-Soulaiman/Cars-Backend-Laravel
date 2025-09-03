<?php

namespace App\Actions\Admin\StoreType;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Repository\StoreTypeRepository;

class GetStoreTypeAction
{
    public function __construct(protected StoreTypeRepository $storeTypeRepository) {}

    public function __invoke()
    {
        $allStoreType = $this->storeTypeRepository->allStoreType();

        return ApiResponseHelper::sendResponse(new Result($allStoreType, 'get data successfully'));
    }
}
