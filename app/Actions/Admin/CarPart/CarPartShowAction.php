<?php

namespace App\Actions\Admin\CarPart;

use App\Models\CarPart;
use App\Repository\CarPartRepository;

class CarPartShowAction
{
    public function __construct(protected CarPartRepository $carPartRepository) {}

    public function __invoke(CarPart $carPart)
    {
        return $this->carPartRepository->showCarPart($carPart);
    }
}
