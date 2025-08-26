<?php

namespace App\Interfaces;

use App\Filter\DealFilter;
use App\Models\Deal;

interface DealInterface
{


    public function showDeal(Deal $rentCategory);

    public function indexDeal(DealFilter $filters);
}
