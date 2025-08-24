<?php

namespace App\Actions\Admin\Color;

use App\Models\Color;
use App\Repository\ColorRepository;

class ColorShowAction
{
    public function __construct(protected ColorRepository $colorRepository) {}

    public function __invoke(Color $color)
    {
        return $this->colorRepository->showColor($color);
    }
}
