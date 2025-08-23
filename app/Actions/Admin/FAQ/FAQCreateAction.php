<?php

namespace App\Actions\Admin\FAQ;

use App\Http\Requests\FAQRequest;
use App\Repository\FAQRepository;

class FAQCreateAction
{
    public function __construct(protected FAQRepository $FAQRepository) {}

    public function __invoke(FAQRequest $request)
    {
        return $this->FAQRepository->addFAQ($request->validated());
    }
}
