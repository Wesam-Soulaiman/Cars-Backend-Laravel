<?php

namespace App\Actions\Admin\RentCategory;

use App\Http\Requests\SearchRentCategoryRequest;
use App\Repository\RentCategoryRepository;

class RentCategoryIndexAction
{
    public function __construct(protected RentCategoryRepository $rentCategoryRepository) {}

    public function __invoke(SearchRentCategoryRequest $request)
    {
        return $this->rentCategoryRepository->indexRentCategory($request->toFilter());
    }
}
