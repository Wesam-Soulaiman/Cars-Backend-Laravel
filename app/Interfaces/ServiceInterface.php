<?php

namespace App\Interfaces;

use App\Models\Service;

interface ServiceInterface
{
    public function getCategory();

    public function getServices();

    public function addService($data);

    public function showService(Service $service);

    public function updateService(Service $service, $data);

    public function deleteService(Service $service);
}
