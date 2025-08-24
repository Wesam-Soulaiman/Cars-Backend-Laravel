<?php

namespace App\Actions\Admin\CarPart;

use App\Http\Requests\CarPartRequest;
use App\Models\CarPart;
use App\Repository\CarPartRepository;

class CarPartUpdateAction
{
    public function __construct(protected CarPartRepository $carPartRepository) {}

    public function __invoke(CarPart $carPart, CarPartRequest $carPartRequest)
    {
        return $this->carPartRepository->updateCarPart($carPart, $carPartRequest->validated());
    }
}
