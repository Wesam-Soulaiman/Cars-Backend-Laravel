<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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
        $serviceId = $this->route('services')?->id;

        if ($serviceId) {
            return [
                'name' => 'nullable|string|max:255',
                'name_ar' => 'nullable|string|max:255',
                'category_service_id' => 'nullable|exists:category_services,id',
                'has_top_result' => 'boolean',
                'services' => 'nullable|array|min:1',
                'services.*' => 'in:sell,rent,parts',
                'description' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'count_product' => 'nullable|integer|min:0',
                'count_days' => 'nullable|integer|min:0',
            ];
        }


        return [
            'name' => 'string|max:255',
            'name_ar' => 'string|max:255',
            'category_service_id' => 'exists:category_services,id',
            'has_top_result' => 'boolean',
            'services' => 'array|min:1',
            'services.*' => 'in:sell,rent,parts',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'count_product' => 'nullable|integer|min:0',
            'count_days' => 'nullable|integer|min:0',
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
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
            'category_service_id.required' => 'حقل معرف فئة الخدمة مطلوب.',
            'category_service_id.exists' => 'فئة الخدمة المحددة غير موجودة.',
            'has_top_result.boolean' => 'يجب أن يكون حقل أعلى النتائج قيمة منطقية.',
            'services.required' => 'حقل الخدمات مطلوب.',
            'services.array' => 'يجب أن تكون الخدمات مصفوفة.',
            'services.min' => 'يجب تحديد خدمة واحدة على الأقل.',
            'services.*.in' => 'الخدمة المحددة غير صالحة، يجب أن تكون إما بيع أو تأجير أو قطع غيار.',
            'description.string' => 'يجب أن يكون الوصف نصيًا.',
            'description_ar.string' => 'يجب أن يكون الوصف بالعربية نصيًا.',
            'count_product.integer' => 'يجب أن يكون عدد المنتجات رقمًا صحيحًا.',
            'count_product.min' => 'يجب ألا يكون عدد المنتجات أقل من 0.',
            'count_days.integer' => 'يجب أن يكون عدد الأيام رقمًا صحيحًا.',
            'count_days.min' => 'يجب ألا يكون عدد الأيام أقل من 0.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors()->all())->unique();

        $response = response()->json([
            'errors' => $errors->all(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
