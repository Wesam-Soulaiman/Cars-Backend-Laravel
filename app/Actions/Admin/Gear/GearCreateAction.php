<?php

namespace App\Actions\Admin\Gear;

use App\Http\Requests\GearRequest;
use App\Repository\GearRepository;

class GearCreateAction
{
    public function __construct(protected GearRepository $gearRepository) {}

    public function __invoke(GearRequest $request)
    {
        return $this->gearRepository->addGear($request->validated());
    }
}
