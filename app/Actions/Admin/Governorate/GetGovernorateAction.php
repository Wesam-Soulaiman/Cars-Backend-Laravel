<?php

namespace App\Actions\Admin\Governorate;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Repository\GovernorateRepository;

class GetGovernorateAction
{
    public function __construct(protected GovernorateRepository $governorateRepository) {}

    public function __invoke()
    {
        $allGovernorate = $this->governorateRepository->allGovernorate();


        return ApiResponseHelper::sendResponse(new Result($allGovernorate, 'get data successfully'));
    }
}
