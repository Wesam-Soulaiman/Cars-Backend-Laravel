<?php

namespace App\Interfaces;

use App\Filter\FeatureFilter;
use App\Models\Feature;

interface FeatureInterface
{
    public function addFeature($data);

    public function updateFeature(Feature $feature, $data);

    public function deleteFeature(Feature $feature);

    public function showFeature(Feature $feature);

    public function indexFeature(FeatureFilter $filters);
}
