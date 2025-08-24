<?php

namespace App\Actions\Admin\Structure;

use App\Http\Requests\StructureRequest;
use App\Repository\StructureRepository;

class StructureCreateAction
{
    public function __construct(protected StructureRepository $structureRepository) {}

    public function __invoke(StructureRequest $request)
    {
        return $this->structureRepository->addStructure($request->validated());
    }
}
