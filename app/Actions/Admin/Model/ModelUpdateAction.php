<?php

namespace App\Actions\Admin\Model;

use App\Http\Requests\ModelRequest;
use App\Models\Model;
use App\Repository\ModelRepository;

class ModelUpdateAction
{
    public function __construct(protected ModelRepository $modelRepository) {}

    public function __invoke(Model $model, ModelRequest $request)
    {
        return $this->modelRepository->updateModel($model, $request->validated());
    }
}
