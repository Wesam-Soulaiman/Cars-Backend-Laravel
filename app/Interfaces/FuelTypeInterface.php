<?php

namespace App\Interfaces;

use App\Filter\FuelTypeFilter;
use App\Models\FuelType;

interface FuelTypeInterface
{
    public function addFuelType($data);

    public function updateFuelType(FuelType $fuelType, $data);

    public function deleteFuelType(FuelType $fuelType);

    public function showFuelType(FuelType $fuelType);

    public function indexFuelType(FuelTypeFilter $filters);
}
