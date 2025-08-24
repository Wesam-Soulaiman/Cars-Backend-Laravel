<?php

namespace App\Actions\Admin\CarPartCategory;

use App\Http\Requests\CarPartCategoryRequest;
use App\Repository\CarPartCategoryRepository;

class CarPartCategoryCreateAction
{
    public function __construct(protected CarPartCategoryRepository $carPartCategoryRepository) {}

    public function __invoke(CarPartCategoryRequest $request)
    {
        return $this->carPartCategoryRepository->addCarPartCategory($request->validated());
    }
}
