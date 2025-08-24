<?php

namespace App\Actions\Admin\Gear;

use App\Http\Requests\GearRequest;
use App\Models\Gear;
use App\Repository\GearRepository;

class GearUpdateAction
{
    public function __construct(protected GearRepository $gearRepository) {}

    public function __invoke(Gear $gear, GearRequest $gearRequest)
    {
        return $this->gearRepository->updateGear($gear, $gearRequest->validated());
    }
}
