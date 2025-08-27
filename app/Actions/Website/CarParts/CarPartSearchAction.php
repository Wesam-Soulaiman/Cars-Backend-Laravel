<?php

namespace App\Actions\Website\CarParts;

use App\Http\Requests\SearchCarPartRequest;
use App\Repository\CarPartRepository;

class CarPartSearchAction
{
    public function __construct(protected CarPartRepository $carPartRepository) {}

    public function __invoke(SearchCarPartRequest $searchCarPartRequest)
    {
        return $this->carPartRepository->SearchCarParts($searchCarPartRequest->toFilter());
    }
}
