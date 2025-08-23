<?php

namespace App\Actions\Admin\Banner;

use App\Http\Requests\PaginationRequest;
use App\Repository\BannerRepository;

class BannerIndexAction
{
    public function __construct(protected BannerRepository $bannerRepository) {}

    public function __invoke(PaginationRequest $request)
    {
        return $this->bannerRepository->indexBanner($request->toFilter());
    }
}
