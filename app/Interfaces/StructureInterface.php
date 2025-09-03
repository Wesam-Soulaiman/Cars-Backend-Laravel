<?php

namespace App\Interfaces;

use App\Filter\StructureFilter;
use App\Models\Structure;

interface StructureInterface
{
    public function addStructure($data);

    public function updateStructure(Structure $structure, $data);

    public function deleteStructure(Structure $structure);

    public function showStructure(Structure $structure);

    public function indexStructure(StructureFilter $filters);

    public function allStructure();
}
