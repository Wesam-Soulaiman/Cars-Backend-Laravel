<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\LegalDocumentFilter;
use App\Interfaces\LegalDocumentInterface;
use App\Models\LegalDocument;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class LegalDocumentRepository extends BaseRepositoryImplementation implements LegalDocumentInterface
{
    public function model()
    {
        return LegalDocument::class;
    }

    public function addLegalDocument($data)
    {
        $legalDocument = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($legalDocument), ApiResponseCodes::CREATED);
    }

    public function updateLegalDocument(LegalDocument $legalDocument, $data)
    {
        $newLegalDocument = $this->updateById($legalDocument->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newLegalDocument));
    }

    public function deleteLegalDocument(LegalDocument $legalDocument)
    {
        $this->deleteById($legalDocument->id);
        return ApiResponseHelper::sendMessageResponse('delete legal document successfully');
    }

    public function showLegalDocument(LegalDocument $legalDocument)
    {
        $showLegalDocument = $this->getById($legalDocument->id, ['id', 'type', 'language', 'content', 'version', 'is_active']);
        return $this->formatAsMarkdownResponse($showLegalDocument);
    }

    public function indexLegalDocument(LegalDocumentFilter $filters)
    {
        if (! is_null($filters->getType())) {
            $this->where('type', $filters->getType());
        }
        if (! is_null($filters->getLanguage())) {
            $this->where('language', $filters->getLanguage());
        }
        if (! is_null($filters->getVersion())) {
            $this->where('version', '%'.$filters->getVersion().'%', 'like');
        }
        if (! is_null($filters->getIsActive())) {
            $this->where('is_active', $filters->getIsActive());
        }
        $legalDocuments = $this->paginate($filters->per_page, ['id', 'type', 'language', 'content', 'version', 'is_active'], 'page', $filters->page);
        $pagination = [
            'total' => $legalDocuments->total(),
            'current_page' => $legalDocuments->currentPage(),
            'last_page' => $legalDocuments->lastPage(),
            'per_page' => $legalDocuments->perPage(),
        ];

        $formattedDocuments = collect($legalDocuments->items())->map(function ($document) {
            return [
                'id' => $document->id,
                'type' => $document->type,
                'language' => $document->language,
                'version' => $document->version,
                'is_active' => $document->is_active,
                'filename' => $this->generateMarkdownFilename($document),
                'url' => URL::route('legal-documents.download', ['legalDocument' => $document->id]),
            ];
        })->toArray();

        return ApiResponseHelper::sendResponseWithPagination(new Result($formattedDocuments, 'get legal documents successfully', $pagination));
    }

    /**
     * Format a single legal document as a downloadable .md file response.
     */
    private function formatAsMarkdownResponse($document)
    {
        $filename = $this->generateMarkdownFilename($document);
        $headers = [
            'Content-Type' => 'text/markdown',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        return new Response($document->content, 200, $headers);
    }

    /**
     * Generate a filename for the Markdown file based on type, language, and version.
     */
    private function generateMarkdownFilename($document)
    {
        return sprintf('%s_%s_%s.md', $document->type, $document->language, $document->version);
    }


    public function getAllLegalDocumentsForFrontend()
    {
        $legalDocuments = $this->all(['id', 'type', 'language', 'version', 'is_active']);

        $formattedDocuments = $legalDocuments->map(function ($document) {
            return [
                'id' => $document->id,
                'type' => $document->type,
                'language' => $document->language,
                'version' => $document->version,
                'is_active' => $document->is_active,
                'filename' => $this->generateMarkdownFilename($document),
                'url' => URL::route('legal-documents.download', ['legalDocument' => $document->id]),
            ];
        })->toArray();

        return ApiResponseHelper::sendResponse(new Result($formattedDocuments, 'get all legal documents successfully'));
    }

    public function downloadLegalDocument(LegalDocument $legalDocument)
    {
        return $this->formatAsMarkdownResponse($legalDocument);
    }



}
