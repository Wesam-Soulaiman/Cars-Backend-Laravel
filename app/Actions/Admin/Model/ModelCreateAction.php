<?php

namespace App\Actions\Admin\Model;

use App\Http\Requests\ModelRequest;
use App\Repository\ModelRepository;

class ModelCreateAction
{
    public function __construct(protected ModelRepository $modelRepository) {}

    public function __invoke(ModelRequest $request)
    {
        return $this->modelRepository->addModel($request->validated());
    }
}
