<?php

namespace App\Actions\Admin\Feature;

use App\Http\Requests\SearchFeatureRequest;
use App\Repository\FeatureRepository;

class FeatureIndexAction
{
    public function __construct(protected FeatureRepository $FAQRepository) {}

    public function __invoke(SearchFeatureRequest $request)
    {
        return $this->FAQRepository->indexFeature($request->toFilter());
    }
}
