<?php

namespace App\Actions\Admin\Light;

use App\Http\Requests\LightRequest;
use App\Repository\LightRepository;

class LightCreateAction
{
    public function __construct(protected LightRepository $lightRepository) {}

    public function __invoke(LightRequest $request)
    {
        return $this->lightRepository->addLight($request->validated());
    }
}
