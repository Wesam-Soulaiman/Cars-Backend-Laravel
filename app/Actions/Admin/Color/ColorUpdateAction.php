<?php

namespace App\Actions\Admin\Color;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use App\Repository\ColorRepository;

class ColorUpdateAction
{
    public function __construct(protected ColorRepository $colorRepository) {}

    public function __invoke(Color $color, ColorRequest $colorRequest)
    {
        return $this->colorRepository->updateColor($color, $colorRequest->validated());
    }
}
