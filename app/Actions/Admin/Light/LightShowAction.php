<?php

namespace App\Actions\Admin\Light;

use App\Models\Light;
use App\Repository\LightRepository;

class LightShowAction
{
    public function __construct(protected LightRepository $lightRepository) {}

    public function __invoke(Light $light)
    {
        return $this->lightRepository->showLight($light);
    }
}
