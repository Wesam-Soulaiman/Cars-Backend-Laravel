<?php

namespace App\Actions\Admin\Feature;

use App\Http\Requests\FeatureRequest;
use App\Repository\FeatureRepository;

class FeatureCreateAction
{
    public function __construct(protected FeatureRepository $featureRepository) {}

    public function __invoke(FeatureRequest $request)
    {
        return $this->featureRepository->addFeature($request->validated());
    }
}
