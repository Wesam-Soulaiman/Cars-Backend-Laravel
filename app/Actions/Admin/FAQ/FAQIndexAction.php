<?php

namespace App\Actions\Admin\FAQ;

use App\Http\Requests\PaginationRequest;
use App\Repository\FAQRepository;

class FAQIndexAction
{
    public function __construct(protected FAQRepository $FAQRepository) {}

    public function __invoke(PaginationRequest $request)
    {
        return $this->FAQRepository->indexFAQ($request->toFilter());
    }
}
