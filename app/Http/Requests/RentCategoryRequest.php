<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RentCategoryRequest extends FormRequest
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
        $rentCategoryId = $this->route('rent-categories')?->id;
        if ($rentCategoryId) {
            return [
                'name' => 'nullable|string|max:255|unique:rent_categories,name,'.$rentCategoryId,
                'name_ar' => 'nullable|string|max:255|unique:rent_categories,name_ar,'.$rentCategoryId,
            ];
        }

        return [
            'name' => 'required|string|max:255|unique:rent_categories,name',
            'name_ar' => 'required|string|max:255|unique:rent_categories,name_ar',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'يجب أن يكون الاسم نصيًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
            'name.unique' => 'هذا الاسم مستخدم بالفعل، الرجاء اختيار اسم آخر.',
            'name_ar.required' => 'حقل الاسم بالعربية مطلوب.',
            'name_ar.string' => 'يجب أن يكون الاسم بالعربية نصيًا.',
            'name_ar.max' => 'يجب ألا يتجاوز الاسم بالعربية 255 حرفًا.',
            'name_ar.unique' => 'هذا الاسم بالعربية مستخدم بالفعل، الرجاء اختيار اسم آخر.',
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
