<?php

namespace App\Actions\Admin\LegalDocument;

use App\Repository\LegalDocumentRepository;

class LegalDocumentDownloadAllAction
{
    public function __construct(protected LegalDocumentRepository $legalDocumentRepository) {}

    public function __invoke()
    {
        return $this->legalDocumentRepository->getAllLegalDocumentsForFrontend();
    }
}
