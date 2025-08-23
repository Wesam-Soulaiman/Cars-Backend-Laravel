<?php

namespace App\Actions\Admin\Services;

use App\Repository\ServiceRepository;

class ServiceAction
{
    public function __construct(protected ServiceRepository $serviceRepository) {}

    public function __invoke()
    {
        return $this->serviceRepository->getServices();
    }
}
