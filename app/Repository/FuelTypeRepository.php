<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\FuelTypeFilter;
use App\Interfaces\FuelTypeInterface;
use App\Models\FuelType;

class FuelTypeRepository extends BaseRepositoryImplementation implements FuelTypeInterface
{
    public function model()
    {
        return FuelType::class;
    }

    public function addFuelType($data)
    {
        $fuelType = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($fuelType), ApiResponseCodes::CREATED);
    }

    public function updateFuelType(FuelType $fuelType, $data)
    {
        $newFuelType = $this->updateById($fuelType->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newFuelType));
    }

    public function deleteFuelType(FuelType $fuelType)
    {
        $this->deleteById($fuelType->id);
        return ApiResponseHelper::sendMessageResponse('delete fuel type successfully');
    }

    public function showFuelType(FuelType $fuelType)
    {
        $showFuelType = $this->getById($fuelType->id, ['id', 'name', 'name_ar']);
        return ApiResponseHelper::sendResponse(new Result($showFuelType));
    }

    public function indexFuelType(FuelTypeFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
        }
        if (! is_null($filters->getNameAr())) {
            $this->where('name_ar', '%'.$filters->getNameAr().'%', 'like');
        }
        $fuelTypes = $this->paginate($filters->per_page, ['id', 'name', 'name_ar'], 'page', $filters->page);
        $pagination = [
            'total' => $fuelTypes->total(),
            'current_page' => $fuelTypes->currentPage(),
            'last_page' => $fuelTypes->lastPage(),
            'per_page' => $fuelTypes->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($fuelTypes->items(), 'get fuel types successfully', $pagination));
    }
}
