<?php

namespace App\Actions\Admin\FuelType;

use App\Http\Requests\SearchFuelTypeRequest;
use App\Repository\FuelTypeRepository;

class FuelTypeIndexAction
{
    public function __construct(protected FuelTypeRepository $fuelTypeRepository) {}

    public function __invoke(SearchFuelTypeRequest $request)
    {
        return $this->fuelTypeRepository->indexFuelType($request->toFilter());
    }
}
