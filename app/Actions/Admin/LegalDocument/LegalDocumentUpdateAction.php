<?php

namespace App\Actions\Admin\LegalDocument;

use App\Http\Requests\LegalDocumentRequest;
use App\Models\LegalDocument;
use App\Repository\LegalDocumentRepository;

class LegalDocumentUpdateAction
{
    public function __construct(protected LegalDocumentRepository $legalDocumentRepository) {}

    public function __invoke(LegalDocument $legalDocument, LegalDocumentRequest $legalDocumentRequest)
    {
        return $this->legalDocumentRepository->updateLegalDocument($legalDocument, $legalDocumentRequest->validated());
    }
}
