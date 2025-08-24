<?php

namespace App\Actions\Admin\FuelType;

use App\Http\Requests\FuelTypeRequest;
use App\Models\FuelType;
use App\Repository\FuelTypeRepository;

class FuelTypeUpdateAction
{
    public function __construct(protected FuelTypeRepository $fuelTypeRepository) {}

    public function __invoke(FuelType $fuelType, FuelTypeRequest $fuelTypeRequest)
    {
        return $this->fuelTypeRepository->updateFuelType($fuelType, $fuelTypeRequest->validated());
    }
}
