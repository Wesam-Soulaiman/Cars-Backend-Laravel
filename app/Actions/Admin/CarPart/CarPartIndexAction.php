<?php

namespace App\Actions\Admin\CarPart;

use App\Http\Requests\SearchCarPartRequest;
use App\Repository\CarPartRepository;

class CarPartIndexAction
{
    public function __construct(protected CarPartRepository $carPartRepository) {}

    public function __invoke(SearchCarPartRequest $request)
    {
        return $this->carPartRepository->indexCarPart($request->toFilter());
    }
}
