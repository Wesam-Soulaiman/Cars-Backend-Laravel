<?php

namespace App\Interfaces;

use App\Filter\ModelFilter;
use App\Models\Model;

interface ModelInterface
{
    public function addModel($data);

    public function updateModel(Model $model, $data);

    public function deleteModel(Model $model);

    public function showModel(Model $model);

    public function indexModel(ModelFilter $filters);
}
