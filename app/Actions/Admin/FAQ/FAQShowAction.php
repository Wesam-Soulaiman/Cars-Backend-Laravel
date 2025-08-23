<?php

namespace App\Actions\Admin\FAQ;

use App\Models\FAQ;
use App\Repository\FAQRepository;

class FAQShowAction
{
    public function __construct(protected FAQRepository $FAQRepository) {}

    public function __invoke(FAQ $FAQ)
    {

        return $this->FAQRepository->showFAQ($FAQ);
    }
}
