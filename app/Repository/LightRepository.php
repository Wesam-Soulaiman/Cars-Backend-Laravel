<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\LightFilter;
use App\Interfaces\LightInterface;
use App\Models\Light;

class LightRepository extends BaseRepositoryImplementation implements LightInterface
{
    public function model()
    {
        return Light::class;
    }

    public function addLight($data)
    {
        $light = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($light), ApiResponseCodes::CREATED);
    }

    public function updateLight(Light $light, $data)
    {
        $newLight = $this->updateById($light->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newLight));
    }

    public function deleteLight(Light $light)
    {
        $this->deleteById($light->id);
        return ApiResponseHelper::sendMessageResponse('delete light successfully');
    }

    public function showLight(Light $light)
    {
        $showLight = $this->getById($light->id, ['id', 'name', 'name_ar']);
        return ApiResponseHelper::sendResponse(new Result($showLight));
    }

    public function indexLight(LightFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
            $this->orWhere('name_ar', '%'.$filters->getName().'%', 'like');

        }
        $lights = $this->paginate($filters->per_page, ['id', 'name', 'name_ar'], 'page', $filters->page);
        $pagination = [
            'total' => $lights->total(),
            'current_page' => $lights->currentPage(),
            'last_page' => $lights->lastPage(),
            'per_page' => $lights->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($lights->items(), 'get lights successfully', $pagination));
    }
}
