<?php

namespace App\Actions\Admin\Gear;

use App\Models\Gear;
use App\Repository\GearRepository;

class GearDestroyAction
{
    public function __construct(protected GearRepository $gearRepository) {}

    public function __invoke(Gear $gear)
    {
        return $this->gearRepository->deleteGear($gear);
    }
}
