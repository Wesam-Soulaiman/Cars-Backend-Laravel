<?php

namespace App\Actions\Admin\Structure;

use App\Models\Structure;
use App\Repository\StructureRepository;

class StructureShowAction
{
    public function __construct(protected StructureRepository $structureRepository) {}

    public function __invoke(Structure $structure)
    {
        return $this->structureRepository->showStructure($structure);
    }
}
