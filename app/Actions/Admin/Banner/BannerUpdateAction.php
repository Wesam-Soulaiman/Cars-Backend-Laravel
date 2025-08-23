<?php

namespace App\Actions\Admin\Banner;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Repository\BannerRepository;

class BannerUpdateAction
{
    public function __construct(protected BannerRepository $bannerRepository) {}

    public function __invoke(Banner $banner, BannerRequest $request)
    {

        return $this->bannerRepository->updateBanner($banner, $request->validated());
    }
}
