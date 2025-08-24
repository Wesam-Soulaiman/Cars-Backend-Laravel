<?php

namespace App\Actions\Admin\Light;

use App\Http\Requests\LightRequest;
use App\Models\Light;
use App\Repository\LightRepository;

class LightUpdateAction
{
    public function __construct(protected LightRepository $lightRepository) {}

    public function __invoke(Light $light, LightRequest $lightRequest)
    {
        return $this->lightRepository->updateLight($light, $lightRequest->validated());
    }
}
