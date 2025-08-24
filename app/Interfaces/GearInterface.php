<?php

namespace App\Interfaces;

use App\Filter\GearFilter;
use App\Models\Gear;

interface GearInterface
{
    public function addGear($data);
    public function updateGear(Gear $gear, $data);

    public function deleteGear(Gear $gear);

    public function showGear(Gear $gear);

    public function indexGear(GearFilter $filters);
}
