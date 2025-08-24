<?php

namespace App\Actions\Admin\FuelType;

use App\Http\Requests\FuelTypeRequest;
use App\Repository\FuelTypeRepository;

class FuelTypeCreateAction
{
    public function __construct(protected FuelTypeRepository $fuelTypeRepository) {}

    public function __invoke(FuelTypeRequest $request)
    {
        return $this->fuelTypeRepository->addFuelType($request->validated());
    }
}
