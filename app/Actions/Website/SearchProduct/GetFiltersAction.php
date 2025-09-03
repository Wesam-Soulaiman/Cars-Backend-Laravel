<?php

namespace App\Actions\Website\SearchProduct;


use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Repository\BrandRepository;
use App\Repository\StoreRepository;
use App\Repository\ModelRepository;
use App\Repository\ColorRepository;
use App\Repository\FuelTypeRepository;
use App\Repository\GearRepository;
use App\Repository\LightRepository;
use App\Repository\DealRepository;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class GetFiltersAction
{
//    public function __construct(protected BrandRepository $brandRepository) {}
//
//    public function __invoke()
//    {
//        $brandsWithModels = $this->brandRepository->GetBrandWithModels();
//        $data = ['brandsWithModels' => $brandsWithModels];
//
//        return ApiResponseHelper::sendResponse(new Result($data, 'get data successfully'));
//    }


    public function __construct(
        protected BrandRepository $brandRepository,
        protected StoreRepository $storeRepository,
        protected ModelRepository $modelRepository,
        protected ColorRepository $colorRepository,
        protected FuelTypeRepository $fuelTypeRepository,
        protected GearRepository $gearRepository,
        protected LightRepository $lightRepository,
        protected DealRepository $dealRepository
    ) {}

    public function __invoke()
    {
        // Fetch related model data
        $brandsWithModels = $this->brandRepository->GetBrandWithModels();
        $stores = $this->storeRepository->all(['id', 'name', 'name_ar']);
        $colors = $this->colorRepository->all(['id', 'name']);
        $fuelTypes = $this->fuelTypeRepository->all(['id', 'name']);
        $gears = $this->gearRepository->all(['id', 'name']);
        $lights = $this->lightRepository->all(['id', 'name']);
        $deals = $this->dealRepository->all(['id', 'name']);

        // Fetch distinct values for non-foreign key fields
        $structureIds = Product::distinct()->pluck('structure_id')->filter()->values();
        $numberOfSeats = Product::distinct()->pluck('number_of_seats')->filter()->values();
        $driveTypes = Product::distinct()->pluck('drive_type')->filter()->values();
        $cylinders = Product::distinct()->pluck('cylinders')->filter()->values();
        $cylinderCapacities = Product::distinct()->pluck('cylinder_capacity')->filter()->values();
        $creationCountries = Product::distinct()->pluck('creation_country')->filter()->values();

        // Fetch min/max for numeric/year fields
        $priceRange = [
            'min' => Product::min('price') ?? 0,
            'max' => Product::max('price') ?? 1000000,
        ];
        $mileageRange = [
            'min' => Product::min('mileage') ?? 0,
            'max' => Product::max('mileage') ?? 500000,
        ];
        $yearRange = [
            'min' => Product::min('year_of_construction') ?? 1900,
            'max' => Product::max('year_of_construction') ?? date('Y'),
        ];
        $registerYearRange = [
            'min' => Product::min('register_year') ?? 1900,
            'max' => Product::max('register_year') ?? date('Y'),
        ];

        // Static filter options
        $booleanOptions = [true, false];
        $typeOptions = ['sedan', 'suv', 'hatchback', 'convertible', 'sports']; // Adjust based on your actual types
        $orderOptions = ['asc', 'desc'];
        $orderByOptions = ['id', 'price', 'year_of_construction', 'register_year', 'mileage'];

        $data = [
            'brandsWithModels' => $brandsWithModels,
            'stores' => $stores,
            'colors' => $colors,
            'fuelTypes' => $fuelTypes,
            'gears' => $gears,
            'lights' => $lights,
            'deals' => $deals,
            'structureIds' => $structureIds,
            'numberOfSeats' => $numberOfSeats,
            'driveTypes' => $driveTypes,
            'cylinders' => $cylinders,
            'cylinderCapacities' => $cylinderCapacities,
            'creationCountries' => $creationCountries,
            'priceRange' => $priceRange,
            'mileageRange' => $mileageRange,
            'yearRange' => $yearRange,
            'registerYearRange' => $registerYearRange,
            'usedOptions' => $booleanOptions,
            'sunroofOptions' => $booleanOptions,
            'typeOptions' => $typeOptions,
            'orderOptions' => $orderOptions,
            'orderByOptions' => $orderByOptions,
        ];

        return ApiResponseHelper::sendResponse(new Result($data, 'get filter data successfully'));
    }
}
