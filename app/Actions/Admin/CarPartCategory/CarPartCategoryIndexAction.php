<?php

namespace App\Actions\Admin\CarPartCategory;

use App\Http\Requests\SearchCarPartCategoryRequest;
use App\Repository\CarPartCategoryRepository;

class CarPartCategoryIndexAction
{
    public function __construct(protected CarPartCategoryRepository $carPartCategoryRepository) {}

    public function __invoke(SearchCarPartCategoryRequest $request)
    {
        return $this->carPartCategoryRepository->indexCarPartCategory($request->toFilter());
    }
}
