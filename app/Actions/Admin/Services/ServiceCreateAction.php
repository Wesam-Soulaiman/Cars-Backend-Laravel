<?php

namespace App\Actions\Admin\Services;

use App\Http\Requests\ServiceRequest;
use App\Repository\ServiceRepository;

class ServiceCreateAction
{
    public function __construct(protected ServiceRepository $serviceRepository) {}

    public function __invoke(ServiceRequest $request)
    {
        return $this->serviceRepository->addService($request->validated());
    }
}
