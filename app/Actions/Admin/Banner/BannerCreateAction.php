<?php

namespace App\Actions\Admin\Banner;

use App\Http\Requests\BannerRequest;
use App\Repository\BannerRepository;

class BannerCreateAction
{
    public function __construct(protected BannerRepository $bannerRepository) {}

    public function __invoke(BannerRequest $request)
    {

        return $this->bannerRepository->addBanner($request->validated());

    }
}
