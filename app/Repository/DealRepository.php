<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\DealFilter;
use App\Interfaces\DealInterface;
use App\Models\Deal;

class DealRepository extends BaseRepositoryImplementation implements DealInterface
{
    public function model()
    {
        return Deal::class;
    }


    public function showDeal(Deal $rentCategory)
    {
        $showRentCategory = $this->getById($rentCategory->id, ['id', 'name', 'name_ar']);
        return ApiResponseHelper::sendResponse(new Result($showRentCategory));
    }

    public function indexDeal(DealFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
        }
        if (! is_null($filters->getNameAr())) {
            $this->where('name_ar', '%'.$filters->getNameAr().'%', 'like');
        }
        $rentCategories = $this->paginate($filters->per_page, ['id', 'name', 'name_ar'], 'page', $filters->page);
        $pagination = [
            'total' => $rentCategories->total(),
            'current_page' => $rentCategories->currentPage(),
            'last_page' => $rentCategories->lastPage(),
            'per_page' => $rentCategories->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($rentCategories->items(), 'get deal successfully', $pagination));
    }
}
