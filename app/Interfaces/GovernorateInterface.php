<?php

namespace App\Interfaces;

use App\Filter\GovernorateFilter;
use App\Models\Governorate;

interface GovernorateInterface
{
    public function showGovernorate(Governorate $governorate);

    public function indexGovernorate(GovernorateFilter $filters);

    public function allGovernorate();
}
