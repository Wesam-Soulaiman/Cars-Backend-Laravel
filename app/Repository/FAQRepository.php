<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\PaginationFilter;
use App\Http\Resources\FAQResource;
use App\Interfaces\FAQInterface;
use App\Models\FAQ;

class FAQRepository extends BaseRepositoryImplementation implements FAQInterface
{
    public function model()
    {
        return FAQ::class;
    }

    public function addFAQ($data)
    {
        $FAQ = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($FAQ), ApiResponseCodes::CREATED);
    }

    public function updateFAQ(FAQ $FAQ, $data)
    {
        $newFAQ = $this->updateById($FAQ->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newFAQ));
    }

    public function deleteFAQ(FAQ $FAQ)
    {
        $this->deleteById($FAQ->id);

        return ApiResponseHelper::sendMessageResponse('delete FAQ  successfully');
    }

    public function showFAQ(FAQ $FAQ)
    {
        $showFAQ = $this->getById($FAQ->id);
        $showFAQ = FAQResource::make($showFAQ);

        return ApiResponseHelper::sendResponse(new Result($showFAQ));
    }

    public function indexFAQ(PaginationFilter $filters)
    {
        $FAQ = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $categories = FAQResource::collection($FAQ);
        $pagination = [
            'total' => $categories->total(),
            'current_page' => $categories->currentPage(),
            'last_page' => $categories->lastPage(),
            'per_page' => $categories->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($categories, 'get FAQs successfully', $pagination));
    }
}
