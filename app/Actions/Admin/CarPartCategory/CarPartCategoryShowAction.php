<?php

namespace App\Actions\Admin\CarPartCategory;

use App\Models\CarPartCategory;
use App\Repository\CarPartCategoryRepository;

class CarPartCategoryShowAction
{
    public function __construct(protected CarPartCategoryRepository $carPartCategoryRepository) {}

    public function __invoke(CarPartCategory $carPartCategory)
    {
        return $this->carPartCategoryRepository->showCarPartCategory($carPartCategory);
    }
}
