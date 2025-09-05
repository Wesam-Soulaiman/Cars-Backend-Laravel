<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\FeatureFilter;
use App\Http\Resources\BrandResource;
use App\Interfaces\BrandInterface;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandRepository extends BaseRepositoryImplementation implements BrandInterface
{
    public function model()
    {
        return Brand::class;
    }

    public function addBrand($data)
    {
        $brand = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($brand), ApiResponseCodes::CREATED);
    }

    public function updateBrand(Brand $brand, $data)
    {
        $newBrand = $this->updateById($brand->id, $data);
        if (isset($data['logo'])) {
            deleteImage($brand->logo);
        }

        return ApiResponseHelper::sendResponse(new Result($newBrand));
    }

    public function deleteBrand(Brand $brand)
    {
        $this->deleteById($brand->id);
        deleteImage($brand->logo);

        return ApiResponseHelper::sendMessageResponse('delete brand  successfully');
    }

    public function showBrand(Brand $brand)
    {
        $showBrand = $this->getById($brand->id, ['id', 'name_ar', 'name' ,'logo' ]);

        return ApiResponseHelper::sendResponse(new Result(BrandResource::make($showBrand) , 'get banners successfully',));
    }

    public function indexBrand(FeatureFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
            $this->orWhere('name_ar', '%'.$filters->getName().'%', 'like');

        }
        $brands = $this->paginate($filters->per_page, ['id', 'name_ar', 'name', 'logo'], 'page', $filters->page);
        $pagination = [
            'total' => $brands->total(),
            'current_page' => $brands->currentPage(),
            'last_page' => $brands->lastPage(),
            'per_page' => $brands->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result(BrandResource::collection($brands->items()), 'get banners successfully', $pagination));
    }

    public function GetBrandWithModels()
    {
        $this->with = ['models:id,brand_id,name'];

        return $this->get(['id', 'name_ar', 'name', DB::raw('CONCAT("'.url('/').'", logo) as logo')]);

    }
}
