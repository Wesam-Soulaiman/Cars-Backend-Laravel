<?php

namespace App\Actions\Admin\Services;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Repository\ServiceRepository;

class ServiceUpdateAction
{
    public function __construct(protected ServiceRepository $serviceRepository) {}

    public function __invoke(Service $service, ServiceRequest $request)
    {
        return $this->serviceRepository->updateService($service, $request->validated());
    }
}
