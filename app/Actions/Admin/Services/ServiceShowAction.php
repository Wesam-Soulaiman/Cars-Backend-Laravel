<?php

namespace App\Actions\Admin\Services;

use App\Models\Service;
use App\Repository\ServiceRepository;

class ServiceShowAction
{
    public function __construct(protected ServiceRepository $serviceRepository) {}

    public function __invoke(Service $service)
    {
        return $this->serviceRepository->showService($service);
    }
}
