<?php

namespace App\Actions\Admin\Statistics;

use App\Repository\StatisticsRepository;

class StatisticsAction
{
    public function __construct(protected StatisticsRepository $statisticsRepository) {}

    public function __invoke()
    {
        return $this->statisticsRepository->Statistics();
    }
}
