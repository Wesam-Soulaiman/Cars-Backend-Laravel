<?php

namespace App\Actions\Admin\Brand;

use App\Models\Brand;
use App\Repository\BrandRepository;

class BrandDestroyAction
{
    public function __construct(protected BrandRepository $brandRepository) {}

    public function __invoke(Brand $brand)
    {
        return $this->brandRepository->deleteBrand($brand);
    }
}
