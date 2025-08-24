<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarPartCategoryRequest extends FormRequest
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
        $brandId = $this->route('car-parts-categories')?->id;
        if ($brandId) {
            return [
                'name' => 'nullable|string|max:255|unique:brands,name,'.$brandId,
                'name_ar' => 'nullable|string|max:255|unique:brands,name_ar,'.$brandId,
            ];

        }

        return [
            'name' => 'required|string|max:255|unique:car_part_categories,name',
            'name_ar' => 'required|string|max:255|unique:car_part_categories,name_ar',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'يجب أن يكون الاسم نصيًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
            'name.unique' => 'هذا الاسم مستخدم بالفعل، الرجاء اختيار اسم آخر.',
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
