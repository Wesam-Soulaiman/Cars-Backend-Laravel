<?php

namespace App\Interfaces;

use App\Filter\LightFilter;
use App\Models\Light;

interface LightInterface
{
    public function addLight($data);

    public function updateLight(Light $light, $data);

    public function deleteLight(Light $light);

    public function showLight(Light $light);

    public function indexLight(LightFilter $filters);
}
