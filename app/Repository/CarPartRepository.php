<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\CarPartFilter;
use App\Interfaces\CarPartInterface;
use App\Models\CarPart;

class CarPartRepository extends BaseRepositoryImplementation implements CarPartInterface
{
    public function model()
    {
        return CarPart::class;
    }

    public function addCarPart($data)
    {
        $carPart = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($carPart), ApiResponseCodes::CREATED);
    }

    public function updateCarPart(CarPart $carPart, $data)
    {
        $newCarPart = $this->updateById($carPart->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newCarPart));
    }

    public function deleteCarPart(CarPart $carPart)
    {
        $this->deleteById($carPart->id);
        return ApiResponseHelper::sendMessageResponse('delete car part successfully');
    }

    public function showCarPart(CarPart $carPart)
    {
        $showCarPart = $this->getById($carPart->id, ['id', 'category_id', 'model_id', 'store_id', 'price', 'creation_country']);
        return ApiResponseHelper::sendResponse(new Result($showCarPart));
    }

    public function indexCarPart(CarPartFilter $filters)
    {
        if (! is_null($filters->getCategoryId())) {
            $this->where('category_id', $filters->getCategoryId());
        }
        if (! is_null($filters->getModelId())) {
            $this->where('model_id', $filters->getModelId());
        }
        if (! is_null($filters->getStoreId())) {
            $this->where('store_id', $filters->getStoreId());
        }
        if (! is_null($filters->getCreationCountry())) {
            $this->where('creation_country', '%'.$filters->getCreationCountry().'%', 'like');
        }
        $carParts = $this->paginate($filters->per_page, ['id', 'category_id', 'model_id', 'store_id', 'price', 'creation_country'], 'page', $filters->page);
        $pagination = [
            'total' => $carParts->total(),
            'current_page' => $carParts->currentPage(),
            'last_page' => $carParts->lastPage(),
            'per_page' => $carParts->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($carParts->items(), 'get car parts successfully', $pagination));
    }
}
