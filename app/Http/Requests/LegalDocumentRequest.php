<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LegalDocumentRequest extends FormRequest
{
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
        $legalDocumentId = $this->route('legalDocument')?->id;
        if ($legalDocumentId) {
            return [
                'type' => 'nullable|string|in:user_agreement,terms_conditions',
                'language' => 'nullable|string|in:en,ar',
                'content' => 'nullable|string',
                'version' => 'nullable|string|max:255',
                'is_active' => 'nullable|boolean',
            ];
        }

        return [
            'type' => 'required|string|in:user_agreement,terms_conditions',
            'language' => 'required|string|in:en,ar',
            'content' => 'required|string',
            'version' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'حقل النوع مطلوب.',
            'type.string' => 'يجب أن يكون النوع نصيًا.',
            'type.in' => 'النوع يجب أن يكون إما "user_agreement" أو "terms_conditions".',
            'language.required' => 'حقل اللغة مطلوب.',
            'language.string' => 'يجب أن تكون اللغة نصية.',
            'language.in' => 'اللغة يجب أن تكون إما "en" أو "ar".',
            'content.required' => 'حقل المحتوى مطلوب.',
            'content.string' => 'يجب أن يكون المحتوى نصيًا.',
            'version.required' => 'حقل الإصدار مطلوب.',
            'version.string' => 'يجب أن يكون الإصدار نصيًا.',
            'version.max' => 'يجب ألا يتجاوز الإصدار 255 حرفًا.',
            'is_active.boolean' => 'يجب أن تكون الحالة نشطة قيمة منطقية (true أو false).',
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
}
