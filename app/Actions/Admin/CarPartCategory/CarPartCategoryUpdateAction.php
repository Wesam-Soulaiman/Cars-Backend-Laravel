<?php

namespace App\Actions\Admin\CarPartCategory;

use App\Http\Requests\CarPartCategoryRequest;
use App\Models\CarPartCategory;
use App\Repository\CarPartCategoryRepository;

class CarPartCategoryUpdateAction
{
    public function __construct(protected CarPartCategoryRepository $carPartCategoryRepository) {}

    public function __invoke(CarPartCategory $carPartCategory, CarPartCategoryRequest $carPartCategoryRequest)
    {

        return $this->carPartCategoryRepository->updateCarPartCategory($carPartCategory, $carPartCategoryRequest->validated());
    }
}
