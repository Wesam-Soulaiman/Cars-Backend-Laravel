<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\StoreTypeFilter;
use App\Http\Resources\StoreTypeResource;
use App\Interfaces\StoreTypeInterface;
use App\Models\StoreType;

class StoreTypeRepository extends BaseRepositoryImplementation implements StoreTypeInterface
{
    public function model()
    {
        return StoreType::class;
    }

    public function addStoreType($data)
    {
        $storeType = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($storeType), ApiResponseCodes::CREATED);
    }

    public function updateStoreType(StoreType $storeType, $data)
    {
        $newStoreType = $this->updateById($storeType->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newStoreType));
    }

    public function deleteStoreType(StoreType $storeType)
    {
        $this->deleteById($storeType->id);
        return ApiResponseHelper::sendMessageResponse('delete store type successfully');
    }

    public function showStoreType(StoreType $storeType)
    {
        $showStoreType = $this->getById($storeType->id, ['id', 'name', 'name_ar']);
        return ApiResponseHelper::sendResponse(new Result($showStoreType));
    }

    public function indexStoreType(StoreTypeFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
            $this->orWhere('name_ar', '%'.$filters->getName().'%', 'like');

        }
        $storeTypes = $this->paginate($filters->per_page, ['id', 'name', 'name_ar'], 'page', $filters->page);
        $pagination = [
            'total' => $storeTypes->total(),
            'current_page' => $storeTypes->currentPage(),
            'last_page' => $storeTypes->lastPage(),
            'per_page' => $storeTypes->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($storeTypes->items(), 'get store types successfully', $pagination));
    }


    public function allStoreType()
    {
        $StoreType = $this->all();

        return StoreTypeResource::collection($StoreType);

    }
}
