<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ModelRequest extends FormRequest
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
        $modelId = $this->route('model')?->id;
        if ($modelId) {
            return [
                'name' => 'nullable|string|max:255|unique:brands,name,'.$modelId,
                'name_ar' => 'nullable|string|max:255|unique:brands,name_ar,'.$modelId,
                'brand_id' => 'nullable|exists:brands,id',
            ];

        }

        return [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
            'brand_id.required' => 'حقل الماركة مطلوب.',
            'brand_id.exists' => 'الماركة المحددة غير موجودة.',
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
