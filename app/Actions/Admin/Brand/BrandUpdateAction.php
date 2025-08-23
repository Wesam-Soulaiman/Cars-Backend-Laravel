<?php

namespace App\Actions\Admin\Brand;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Repository\BrandRepository;

class BrandUpdateAction
{
    public function __construct(protected BrandRepository $brandRepository) {}

    public function __invoke(Brand $brand, BrandRequest $brandRequest)
    {

        return $this->brandRepository->updateBrand($brand, $brandRequest->validated());
    }
}
