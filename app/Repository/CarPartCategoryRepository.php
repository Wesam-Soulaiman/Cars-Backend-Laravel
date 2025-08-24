<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\CarPartCategoryFilter;
use App\Interfaces\CarPartCategoryInterface;
use \App\Models\CarPartCategory;
class CarPartCategoryRepository extends BaseRepositoryImplementation implements CarPartCategoryInterface
{
    public function model()
    {
        return CarPartCategory::class;
    }

    public function addCarPartCategory($data)
    {
        $carPartCategory = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($carPartCategory), ApiResponseCodes::CREATED);
    }

    public function updateCarPartCategory(CarPartCategory $carPartCategory, $data)
    {
        $newCarPartCategory = $this->updateById($carPartCategory->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newCarPartCategory));
    }

    public function deleteCarPartCategory(CarPartCategory $carPartCategory)
    {
        $this->deleteById($carPartCategory->id);
        return ApiResponseHelper::sendMessageResponse('delete car part category successfully');
    }

    public function showCarPartCategory(CarPartCategory $carPartCategory)
    {
        $showcarPartCategory = $this->getById($carPartCategory->id, ['id', 'name_ar', 'name']);
        return ApiResponseHelper::sendResponse(new Result($showcarPartCategory));
    }

    public function indexCarPartCategory(CarPartCategoryFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
        }
        if (! is_null($filters->getNameAr())) {
            $this->where('name_ar', '%'.$filters->getNameAr().'%', 'like');
        }
        $carPartCategory = $this->paginate($filters->per_page, ['id', 'name_ar', 'name'], 'page', $filters->page);
        $pagination = [
            'total' => $carPartCategory->total(),
            'current_page' => $carPartCategory->currentPage(),
            'last_page' => $carPartCategory->lastPage(),
            'per_page' => $carPartCategory->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($carPartCategory->items(), 'get car part categories successfully', $pagination));
    }

}
