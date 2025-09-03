<?php

namespace App\Interfaces;

use App\Filter\LegalDocumentFilter;
use App\Models\LegalDocument;

interface LegalDocumentInterface
{
    public function addLegalDocument($data);

    public function updateLegalDocument(LegalDocument $legalDocument, $data);

    public function deleteLegalDocument(LegalDocument $legalDocument);

    public function showLegalDocument(LegalDocument $legalDocument);

    public function indexLegalDocument(LegalDocumentFilter $filters);
//     function formatAsMarkdownResponse($document);
//
//
//     function generateMarkdownFilename($document);
}
