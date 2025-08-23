<?php

namespace App\Actions\Admin\FAQ;

use App\Http\Requests\FAQRequest;
use App\Models\FAQ;
use App\Repository\FAQRepository;

class FAQUpdateAction
{
    public function __construct(protected FAQRepository $FAQRepository) {}

    public function __invoke(FAQ $FAQ, FAQRequest $request)
    {

        return $this->FAQRepository->updateFAQ($FAQ, $request->validated());
    }
}
