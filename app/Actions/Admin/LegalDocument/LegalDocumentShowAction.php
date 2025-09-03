<?php

namespace App\Actions\Admin\LegalDocument;

use App\Models\LegalDocument;
use App\Repository\LegalDocumentRepository;

class LegalDocumentShowAction
{
    public function __construct(protected LegalDocumentRepository $legalDocumentRepository) {}

    public function __invoke(LegalDocument $legalDocument)
    {
        return $this->legalDocumentRepository->showLegalDocument($legalDocument);
    }
}
