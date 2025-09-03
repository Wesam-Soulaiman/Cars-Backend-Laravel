<?php

namespace App\Http\Requests;

use App\Filter\LegalDocumentFilter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchLegalDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'nullable|string|in:user_agreement,terms_conditions',
            'language' => 'nullable|string|in:en,ar',
            'version' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors()->all())->unique();

        $response = response()->json([
            'errors' => $errors->all(),
        ], 422);

        throw new HttpResponseException($response);
    }

    public function toFilter(): LegalDocumentFilter
    {
        $filter = new LegalDocumentFilter;
        if ($this->input('type') !== null) {
            $filter->setType($this->input('type'));
        }
        if ($this->input('language') !== null) {
            $filter->setLanguage($this->input('language'));
        }
        if ($this->input('version') !== null) {
            $filter->setVersion($this->input('version'));
        }
        if ($this->input('is_active') !== null) {
            $filter->setIsActive($this->input('is_active'));
        }
        if ($this->input('page') !== null) {
            $filter->setPage($this->input('page'));
        }
        if ($this->input('per_page') !== null) {
            $filter->setPerPage($this->input('per_page'));
        }

        return $filter;
    }
}
