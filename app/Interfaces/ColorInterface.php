<?php

namespace App\Interfaces;

use App\Filter\ColorFilter;
use App\Models\Color;

interface ColorInterface
{
    public function addColor($data);

    public function updateColor(Color $color, $data);

    public function deleteColor(Color $color);

    public function showColor(Color $color);

    public function indexColor(ColorFilter $filters);

}
