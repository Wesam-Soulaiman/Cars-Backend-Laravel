<?php

namespace App\Actions\Admin\CarPartCategory;

use App\Models\CarPartCategory;
use App\Repository\CarPartCategoryRepository;

class CarPartCategoryDestroyAction
{
    public function __construct(protected CarPartCategoryRepository $carPartCategoryRepository) {}


    public function __invoke(CarPartCategory $carPartCategory)
    {
        return $this->carPartCategoryRepository->deleteCarPartCategory($carPartCategory);
    }
}
