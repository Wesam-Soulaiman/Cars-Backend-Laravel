<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
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

        $orderId = $this->route('order')?->id;
        if ($orderId) {
            return [
                'service_id' => 'nullable|exists:services,id',
                'store_id' => 'nullable|exists:stores,id',
                'price' => 'nullable|numeric',
                'start_time' => 'nullable|date',
                'count_days' => 'nullable|numeric',
                'active' => 'nullable|bool',

            ];
        }

        return [
            'service_id' => 'required|exists:services,id',
            'store_id' => 'required|exists:stores,id',
            'price' => 'required|numeric',
            'start_time' => 'nullable|date',
            'count_days' => 'nullable|numeric',
            'active' => 'nullable|bool',

        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'حقل الخدمة مطلوب.',
            'service_id.exists' => 'الخدمة المحددة غير موجودة.',

            'store_id.required' => 'حقل المتجر مطلوب.',
            'store_id.exists' => 'المتجر المحدد غير موجود.',

            'price.required' => 'حقل السعر مطلوب.',
            'price.numeric' => 'يجب أن يكون السعر رقماً.',

            'start_time.date' => 'يجب أن يكون وقت البدء تاريخًا صالحًا.',

            'count_days.numeric' => 'يجب أن يكون عدد الأيام رقماً.',
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
