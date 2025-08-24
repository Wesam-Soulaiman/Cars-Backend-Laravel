<?php

namespace App\Actions\Admin\Structure;

use App\Http\Requests\StructureRequest;
use App\Models\Structure;
use App\Repository\StructureRepository;

class StructureUpdateAction
{
    public function __construct(protected StructureRepository $structureRepository) {}

    public function __invoke(Structure $structure, StructureRequest $structureRequest)
    {
        return $this->structureRepository->updateStructure($structure, $structureRequest->validated());
    }
}
