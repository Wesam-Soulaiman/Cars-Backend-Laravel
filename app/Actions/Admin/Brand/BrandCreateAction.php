<?php

namespace App\Actions\Admin\Brand;

use App\Http\Requests\BrandRequest;
use App\Repository\BrandRepository;

class BrandCreateAction
{
    public function __construct(protected BrandRepository $brandRepository) {}

    public function __invoke(BrandRequest $request)
    {
        return $this->brandRepository->addBrand($request->validated());
    }
}
