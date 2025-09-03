<?php

namespace App\Actions\Admin\Store;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Requests\FilterStoreRequest;
use App\Repository\GovernorateRepository;
use App\Repository\StoreRepository;

class GetFilterStoreAction
{
    public function __construct(protected GovernorateRepository $governorateRepository) {}

    public function __invoke()
    {
        // Fetch all governorates
        $governorates = $this->governorateRepository->all(['id', 'name', 'name_ar']);

        $data = [
            'governorates' => $governorates,
            // 'name' filter is free-text, so no predefined options are needed
        ];

        return ApiResponseHelper::sendResponse(new Result($data, 'get store filter data successfully'));
    }
}
