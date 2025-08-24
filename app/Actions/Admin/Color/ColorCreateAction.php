<?php

namespace App\Actions\Admin\Color;

use App\Http\Requests\ColorRequest;
use App\Repository\ColorRepository;

class ColorCreateAction
{
    public function __construct(protected ColorRepository $colorRepository) {}

    public function __invoke(ColorRequest $request)
    {
        return $this->colorRepository->addColor($request->validated());
    }
}
