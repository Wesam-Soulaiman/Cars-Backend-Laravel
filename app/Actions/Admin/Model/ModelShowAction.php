<?php

namespace App\Actions\Admin\Model;

use App\Models\Model;
use App\Repository\ModelRepository;

class ModelShowAction
{
    public function __construct(protected ModelRepository $modelRepository) {}

    public function __invoke(Model $model)
    {
        return $this->modelRepository->showModel($model);
    }
}
