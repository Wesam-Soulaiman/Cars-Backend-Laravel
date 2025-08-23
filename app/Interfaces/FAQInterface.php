<?php

namespace App\Interfaces;

use App\Filter\PaginationFilter;
use App\Models\FAQ;

interface FAQInterface
{
    public function addFAQ($data);

    public function updateFAQ(FAQ $FAQ, $data);

    public function deleteFAQ(FAQ $FAQ);

    public function showFAQ(FAQ $FAQ);

    public function indexFAQ(PaginationFilter $filters);
}
