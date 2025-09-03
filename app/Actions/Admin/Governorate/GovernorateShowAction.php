<?php

namespace App\Actions\Admin\Governorate;

use App\Models\Governorate;
use App\Repository\GovernorateRepository;

class GovernorateShowAction
{
    public function __construct(protected GovernorateRepository $governorateRepository) {}

    public function __invoke(Governorate $governorate)
    {
        return $this->governorateRepository->showGovernorate($governorate);
    }
}
