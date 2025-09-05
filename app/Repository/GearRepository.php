<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\GearFilter;
use App\Interfaces\GearInterface;
use App\Models\Gear;

class GearRepository extends BaseRepositoryImplementation implements GearInterface
{
    public function model()
    {
        return Gear::class;
    }

    public function addGear($data)
    {
        $gear = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($gear), ApiResponseCodes::CREATED);
    }

    public function updateGear(Gear $gear, $data)
    {
        $newGear = $this->updateById($gear->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newGear));
    }

    public function deleteGear(Gear $gear)
    {
        $this->deleteById($gear->id);
        return ApiResponseHelper::sendMessageResponse('delete gear successfully');
    }

    public function showGear(Gear $gear)
    {
        $showGear = $this->getById($gear->id, ['id', 'name', 'name_ar']);
        return ApiResponseHelper::sendResponse(new Result($showGear));
    }

    public function indexGear(GearFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
            $this->orWhere('name_ar', '%'.$filters->getName().'%', 'like');

        }
        $gears = $this->paginate($filters->per_page, ['id', 'name', 'name_ar'], 'page', $filters->page);
        $pagination = [
            'total' => $gears->total(),
            'current_page' => $gears->currentPage(),
            'last_page' => $gears->lastPage(),
            'per_page' => $gears->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($gears->items(), 'get gears successfully', $pagination));
    }
}
