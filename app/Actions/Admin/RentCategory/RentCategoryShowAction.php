<?php

namespace App\Actions\Admin\RentCategory;

use App\Models\RentCategory;
use App\Repository\RentCategoryRepository;

class RentCategoryShowAction
{
    public function __construct(protected RentCategoryRepository $rentCategoryRepository) {}

    public function __invoke(RentCategory $rentCategory)
    {
        return $this->rentCategoryRepository->showRentCategory($rentCategory);
    }
}
