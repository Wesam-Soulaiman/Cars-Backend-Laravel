<?php

namespace App\Actions\Admin\Governorate;

use App\Http\Requests\SearchGovernorateRequest;
use App\Repository\GovernorateRepository;

class GovernorateIndexAction
{
    public function __construct(protected GovernorateRepository $governorateRepository) {}

    public function __invoke(SearchGovernorateRequest $request)
    {
        return $this->governorateRepository->indexGovernorate($request->toFilter());
    }
}
