<?php

namespace App\Actions\Admin\Deal;

use App\Models\Deal;
use App\Repository\DealRepository;

class DealShowAction
{
    public function __construct(protected DealRepository $rentCategoryRepository) {}

    public function __invoke(Deal $deal)
    {
        return $this->rentCategoryRepository->showDeal($deal);
    }
}
