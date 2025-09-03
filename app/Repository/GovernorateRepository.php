<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\GovernorateFilter;
use App\Http\Resources\GovernorateResource;
use App\Interfaces\GovernorateInterface;
use App\Models\Governorate;

class GovernorateRepository extends BaseRepositoryImplementation implements GovernorateInterface
{
    public function model()
    {
        return Governorate::class;
    }


    public function showGovernorate(Governorate $governorate)
    {
        $showGovernorate = $this->getById($governorate->id, ['id', 'name', 'name_ar']);
        return ApiResponseHelper::sendResponse(new Result($showGovernorate));
    }

    public function indexGovernorate(GovernorateFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
        }
        if (! is_null($filters->getNameAr())) {
            $this->where('name_ar', '%'.$filters->getNameAr().'%', 'like');
        }
        $governorates = $this->paginate($filters->per_page, ['id', 'name', 'name_ar'], 'page', $filters->page);
        $pagination = [
            'total' => $governorates->total(),
            'current_page' => $governorates->currentPage(),
            'last_page' => $governorates->lastPage(),
            'per_page' => $governorates->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($governorates->items(), 'get governorates successfully', $pagination));
    }

    public function allGovernorate()
    {
        $Governorate = $this->all();

        return GovernorateResource::collection($Governorate);

    }
}
