<?php

namespace App\Actions\Admin\Feature;

use App\Models\Feature;
use App\Repository\FeatureRepository;

class FeatureDestroyAction
{
    public function __construct(protected FeatureRepository $featureRepository) {}

    public function __invoke(Feature $feature)
    {

        return $this->featureRepository->deleteFeature($feature);
    }
}
