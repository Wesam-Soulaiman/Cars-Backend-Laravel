<?php

namespace App\Actions\Admin\Light;

use App\Http\Requests\SearchLightRequest;
use App\Repository\LightRepository;

class LightIndexAction
{
    public function __construct(protected LightRepository $lightRepository) {}

    public function __invoke(SearchLightRequest $request)
    {
        return $this->lightRepository->indexLight($request->toFilter());
    }
}
