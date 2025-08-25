<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Resources\ServiceResource;
use App\Interfaces\ServiceInterface;
use App\Models\CategoryService;
use App\Models\Service;

class ServiceRepository extends BaseRepositoryImplementation implements ServiceInterface
{
    public function model()
    {
        return Service::class;
    }

    public function getCategory()
    {
        $categories = CategoryService::select('id', 'name')->get();

        return ApiResponseHelper::sendResponse(new Result($categories, 'get categories successfully'));
    }

    public function addService($data)
    {
        $service = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($service), ApiResponseCodes::CREATED);
    }

    public function getServices()
    {
        $this->with = ['category'];
        $services = $this->get();
        $services = ServiceResource::collection($services);

        return ApiResponseHelper::sendResponse(new Result($services));
    }

    public function updateService(Service $service, $data)
    {
        $newService = $this->updateById($service->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newService));
    }

    public function deleteService(Service $service)
    {
        $this->deleteById($service->id);

        return ApiResponseHelper::sendMessageResponse('delete service  successfully');
    }

    public function showService(Service $service)
    {
        $this->with = ['category'];
        $showService = $this->getById($service->id);
        $showService = ServiceResource::make($showService);
        return ApiResponseHelper::sendResponse(new Result($showService));
    }
}
