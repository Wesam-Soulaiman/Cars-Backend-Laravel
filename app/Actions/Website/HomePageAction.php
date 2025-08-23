<?php

namespace App\Actions\Website;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Repository\BannerRepository;
use App\Repository\BrandRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;

class HomePageAction
{
    public function __construct(protected BrandRepository $brandRepository, protected ProductRepository $productRepository, protected StoreRepository $storeRepository, protected BannerRepository $bannerRepository) {}

    public function __invoke()
    {
        $brandsWithModels = $this->brandRepository->GetBrandWithModels();
        $storeSpecial = $this->storeRepository->storeSpecial();
        $productSpecial = $this->productRepository->productSpecial();
        $productCountAvailable = $this->productRepository->productCountAvailable();
        $banner = $this->bannerRepository->allBanner();
        $data = [
            'banner' => $banner,
            'productCountAvailable' => $productCountAvailable,
            'brandsWithModels' => $brandsWithModels,
            'storeSpecial' => $storeSpecial,
            'productSpecial' => $productSpecial,
        ];

        return ApiResponseHelper::sendResponse(new Result($data, 'get data successfully'));
    }
}
