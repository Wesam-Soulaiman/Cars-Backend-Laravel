<?php

namespace App\Actions\Admin\CarPart;

use App\Http\Requests\CarPartRequest;
use App\Repository\CarPartRepository;

class CarPartCreateAction
{
    public function __construct(protected CarPartRepository $carPartRepository) {}

    public function __invoke(CarPartRequest $request)
    {
        return $this->carPartRepository->addCarPart($request->validated());
    }
}
