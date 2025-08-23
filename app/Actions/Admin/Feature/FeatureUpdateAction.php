<?php

namespace App\Actions\Admin\Feature;

use App\Http\Requests\FeatureRequest;
use App\Models\Feature;
use App\Repository\FeatureRepository;

class FeatureUpdateAction
{
    public function __construct(protected FeatureRepository $featureRepository) {}

    public function __invoke(Feature $feature, FeatureRequest $request)
    {

        return $this->featureRepository->updateFeature($feature, $request->validated());
    }
}
