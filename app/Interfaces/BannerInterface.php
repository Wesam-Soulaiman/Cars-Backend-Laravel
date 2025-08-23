<?php

namespace App\Interfaces;

use App\Filter\PaginationFilter;
use App\Models\Banner;

interface BannerInterface
{
    public function addBanner($data);

    public function updateBanner(Banner $banner, $data);

    public function deleteBanner(Banner $banner);

    public function showBanner(Banner $banner);

    public function indexBanner(PaginationFilter $filters);

    public function allBanner();
}
