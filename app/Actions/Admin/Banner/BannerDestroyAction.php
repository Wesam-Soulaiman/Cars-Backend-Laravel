<?php

namespace App\Actions\Admin\Banner;

use App\Models\Banner;
use App\Repository\BannerRepository;

class BannerDestroyAction
{
    public function __construct(protected BannerRepository $bannerRepository) {}

    public function __invoke(Banner $banner)
    {

        return $this->bannerRepository->deleteBanner($banner);
    }
}
