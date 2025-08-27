<?php

namespace App\Actions\Website\CarParts;

use App\Repository\CarPartRepository;

class CarPartShowAction
{
    public function __construct(protected CarPartRepository $carPartRepository) {}

    public function __invoke($id)
    {
        return $this->carPartRepository->getCarPartById($id);
    }
}
