<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FAQRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return $this->isUpdate()
            ? $this->updateRules()
            : $this->createRules();
    }

    /**
     * Validation rules for creating a category.
     */
    protected function createRules(): array
    {
        return [
            'question' => ['required', 'string'],
            'question_ar' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'answer_ar' => ['required', 'string'],
        ];
    }

    /**
     * Validation rules for updating a category.
     */
    protected function updateRules(): array
    {
        return [
            'question' => ['nullable', 'string'],
            'question_ar' => ['nullable', 'string'],
            'answer' => ['nullable', 'string'],
            'answer_ar' => ['nullable', 'string'],

        ];
    }

    /**
     * Check if the request is for updating.
     */
    protected function isUpdate(): bool
    {
        return ! is_null($this->route('FAQ'));
    }

    /**
     * Custom validation error messages.
     */
    public function messages(): array
    {
        return [
            'active.boolean' => 'يجب أن يكون حقل الشعار قيمة منطقية (نعم/لا).',
            'photo.image' => 'يجب أن يكون الشعار صورة.',
            'photo.max' => 'يجب ألا يتجاوز حجم الشعار 4 ميجابايت.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => collect($validator->errors()->all())->unique()->values(),
        ], 422));
    }
}
