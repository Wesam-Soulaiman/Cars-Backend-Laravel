<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FeatureRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'name_ar' => ['required', 'string'],
        ];
    }

    /**
     * Validation rules for updating a category.
     */
    protected function updateRules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'name_ar' => ['nullable', 'string'],

        ];
    }

    /**
     * Check if the request is for updating.
     */
    protected function isUpdate(): bool
    {
        return ! is_null($this->route('feature'));
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
