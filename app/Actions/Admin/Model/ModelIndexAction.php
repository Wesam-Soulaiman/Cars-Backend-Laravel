<?php

namespace App\Actions\Admin\Model;

use App\Http\Requests\SearchModelRequest;
use App\Repository\ModelRepository;

class ModelIndexAction
{
    public function __construct(protected ModelRepository $modelRepository) {}

    public function __invoke(SearchModelRequest $request)
    {
        return $this->modelRepository->indexModel($request->toFilter());
    }
}
