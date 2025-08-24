<?php

namespace App\Actions\Admin\Gear;

use App\Http\Requests\SearchGearRequest;
use App\Repository\GearRepository;

class GearIndexAction
{
    public function __construct(protected GearRepository $gearRepository) {}

    public function __invoke(SearchGearRequest $request)
    {
        return $this->gearRepository->indexGear($request->toFilter());
    }
}
