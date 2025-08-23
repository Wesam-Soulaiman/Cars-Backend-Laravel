<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BrandRequest extends FormRequest
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
        $brandId = $this->route('brand')?->id;
        if ($brandId) {
            return [
                'name' => 'nullable|string|max:255|unique:brands,name,'.$brandId,
                'name_ar' => 'nullable|string|max:255|unique:brands,name_ar,'.$brandId,
                'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ];

        }

        return [
            'name' => 'required|string|max:255|unique:brands,name',
            'name_ar' => 'required|string|max:255|unique:brands,name_ar',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'يجب أن يكون الاسم نصيًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
            'name.unique' => 'هذا الاسم مستخدم بالفعل، الرجاء اختيار اسم آخر.',
            'logo.required' => 'حقل الشعار مطلوب.',
            'logo.image' => 'يجب أن يكون الشعار صورة.',
            'logo.mimes' => 'يجب أن يكون الشعار بامتداد: jpg, jpeg, png.',
            'logo.max' => 'يجب ألا يتجاوز حجم الشعار 2 ميجابايت.',
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
