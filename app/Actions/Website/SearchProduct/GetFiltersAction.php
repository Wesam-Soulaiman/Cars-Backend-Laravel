<?php

namespace App\Actions\Website\SearchProduct;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Repository\BrandRepository;

class GetFiltersAction
{
    public function __construct(protected BrandRepository $brandRepository) {}

    public function __invoke()
    {
        $brandsWithModels = $this->brandRepository->GetBrandWithModels();
        $data = ['brandsWithModels' => $brandsWithModels];

        return ApiResponseHelper::sendResponse(new Result($data, 'get data successfully'));
    }
}
