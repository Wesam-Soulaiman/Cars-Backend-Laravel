<?php

namespace App\Actions\Admin\Color;

use App\Http\Requests\SearchColorRequest;
use App\Repository\ColorRepository;

class ColorIndexAction
{
    public function __construct(protected ColorRepository $colorRepository) {}

    public function __invoke(SearchColorRequest $request)
    {
        return $this->colorRepository->indexColor($request->toFilter());
    }
}
