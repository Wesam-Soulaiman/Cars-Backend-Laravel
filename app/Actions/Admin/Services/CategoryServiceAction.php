<?php

namespace App\Actions\Admin\Services;

use App\Repository\ServiceRepository;

class CategoryServiceAction
{
    public function __construct(protected ServiceRepository $serviceRepository) {}

    public function __invoke()
    {
        return $this->serviceRepository->getCategory();
    }
}
