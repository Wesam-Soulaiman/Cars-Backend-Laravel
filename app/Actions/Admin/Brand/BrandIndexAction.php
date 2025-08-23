<?php

namespace App\Actions\Admin\Brand;

use App\Http\Requests\SearchBrandRequest;
use App\Repository\BrandRepository;

class BrandIndexAction
{
    public function __construct(protected BrandRepository $brandRepository) {}

    public function __invoke(SearchBrandRequest $request)
    {
        return $this->brandRepository->indexBrand($request->toFilter());
    }
}
