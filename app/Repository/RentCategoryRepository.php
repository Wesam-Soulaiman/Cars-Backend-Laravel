<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\RentCategoryFilter;
use App\Interfaces\RentCategoryInterface;
use App\Models\RentCategory;

class RentCategoryRepository extends BaseRepositoryImplementation implements RentCategoryInterface
{
    public function model()
    {
        return RentCategory::class;
    }


    public function showRentCategory(RentCategory $rentCategory)
    {
        $showRentCategory = $this->getById($rentCategory->id, ['id', 'name', 'name_ar']);
        return ApiResponseHelper::sendResponse(new Result($showRentCategory));
    }

    public function indexRentCategory(RentCategoryFilter $filters)
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

        return ApiResponseHelper::sendResponseWithPagination(new Result($rentCategories->items(), 'get rent categories successfully', $pagination));
    }
}
