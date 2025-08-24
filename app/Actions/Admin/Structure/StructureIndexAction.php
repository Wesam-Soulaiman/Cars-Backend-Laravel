<?php

namespace App\Actions\Admin\Structure;

use App\Http\Requests\SearchStructureRequest;
use App\Repository\StructureRepository;

class StructureIndexAction
{
    public function __construct(protected StructureRepository $structureRepository) {}

    public function __invoke(SearchStructureRequest $request)
    {
        return $this->structureRepository->indexStructure($request->toFilter());
    }
}
