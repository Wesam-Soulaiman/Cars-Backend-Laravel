<?php

namespace App\Actions\Admin\FuelType;

use App\Models\FuelType;
use App\Repository\FuelTypeRepository;

class FuelTypeDestroyAction
{
    public function __construct(protected FuelTypeRepository $fuelTypeRepository) {}

    public function __invoke(FuelType $fuelType)
    {
        return $this->fuelTypeRepository->deleteFuelType($fuelType);
    }
}
