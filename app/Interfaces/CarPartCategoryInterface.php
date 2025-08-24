<?php

namespace App\Interfaces;

use App\Filter\CarPartCategoryFilter;
use App\Models\CarPartCategory;

interface CarPartCategoryInterface
{
    public function addCarPartCategory($data);

    public function updateCarPartCategory(CarPartCategory $carPartCategory, $data);

    public function deleteCarPartCategory(CarPartCategory $carPartCategory);

    public function showCarPartCategory(CarPartCategory $carPartCategory);

    public function indexCarPartCategory(CarPartCategoryFilter $filters);


}
