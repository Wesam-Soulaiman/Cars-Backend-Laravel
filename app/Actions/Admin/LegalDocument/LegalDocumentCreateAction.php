<?php

namespace App\Actions\Admin\LegalDocument;

use App\Http\Requests\LegalDocumentRequest;
use App\Repository\LegalDocumentRepository;

class LegalDocumentCreateAction
{
    public function __construct(protected LegalDocumentRepository $legalDocumentRepository) {}

    public function __invoke(LegalDocumentRequest $request)
    {
        return $this->legalDocumentRepository->addLegalDocument($request->validated());
    }
}
