<?php

namespace App\Interfaces;

use App\Filter\RentCategoryFilter;
use App\Models\RentCategory;

interface RentCategoryInterface
{


    public function showRentCategory(RentCategory $rentCategory);

    public function indexRentCategory(RentCategoryFilter $filters);
}
