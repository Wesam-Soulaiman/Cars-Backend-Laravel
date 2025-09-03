<?php

namespace App\Actions\Website\CarParts;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Repository\CarPartCategoryRepository;
use App\Repository\ModelRepository;
use App\Repository\StoreRepository;
use App\Models\CarPart;

class GetCarPartFiltersAction
{
    public function __construct(
        protected CarPartCategoryRepository $categoryRepository,
        protected ModelRepository $modelRepository,
        protected StoreRepository $storeRepository
    ) {}

    public function __invoke()
    {
        // Fetch related model data
        $categories = $this->categoryRepository->all(['id', 'name']);
        $models = $this->modelRepository->all(['id', 'name', 'brand_id']);
        $stores = $this->storeRepository->all(['id', 'name', 'name_ar']);

        // Fetch distinct creation countries
        $creationCountries = CarPart::distinct()->pluck('creation_country')->filter()->values();

        // Fetch min/max for price
        $priceRange = [
            'min' => CarPart::min('price') ?? 0,
            'max' => CarPart::max('price') ?? 100000,
        ];

        // Static filter options
        $orderByOptions = ['id', 'price'];
        $orderOptions = ['asc', 'desc'];

        $data = [
            'categories' => $categories,
            'models' => $models,
            'stores' => $stores,
            'creationCountries' => $creationCountries,
            'priceRange' => $priceRange,
            'orderByOptions' => $orderByOptions,
            'orderOptions' => $orderOptions,
        ];

        return ApiResponseHelper::sendResponse(new Result($data, 'get car part filter data successfully'));
    }
}
