<?php

namespace App\Actions\Admin\LegalDocument;

use App\Http\Requests\SearchLegalDocumentRequest;
use App\Repository\LegalDocumentRepository;

class LegalDocumentIndexAction
{
    public function __construct(protected LegalDocumentRepository $legalDocumentRepository) {}

    public function __invoke(SearchLegalDocumentRequest $request)
    {
        return $this->legalDocumentRepository->indexLegalDocument($request->toFilter());
    }
}
