<?php

namespace App\Interfaces;

use App\Filter\FeatureFilter;
use App\Models\Brand;

interface BrandInterface
{
    public function addBrand($data);

    public function updateBrand(Brand $brand, $data);

    public function deleteBrand(Brand $brand);

    public function showBrand(Brand $brand);

    public function indexBrand(FeatureFilter $filters);

    public function GetBrandWithModels();
}
