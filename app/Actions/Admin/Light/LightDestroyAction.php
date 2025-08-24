<?php

namespace App\Actions\Admin\Light;

use App\Models\Light;
use App\Repository\LightRepository;

class LightDestroyAction
{
    public function __construct(protected LightRepository $lightRepository) {}

    public function __invoke(Light $light)
    {
        return $this->lightRepository->deleteLight($light);
    }
}
