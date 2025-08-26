<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarPartRequest extends FormRequest
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
        $carPartId = $this->route('car-part')?->id;
        if ($carPartId) {
            return [
                'category_id' => 'nullable|integer|exists:car_part_categories,id',
                'model_id' => 'nullable|integer|exists:models,id',
                'price' => 'nullable|numeric|min:0',
                'creation_country' => 'nullable|string|max:255',
            ];
        }

        return [
            'category_id' => 'required|integer|exists:car_part_categories,id',
            'model_id' => 'required|integer|exists:models,id',
            'price' => 'required|numeric|min:0',
            'creation_country' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'حقل معرف الفئة مطلوب.',
            'category_id.integer' => 'يجب أن يكون معرف الفئة عددًا صحيحًا.',
            'category_id.exists' => 'معرف الفئة غير موجود.',
            'model_id.required' => 'حقل معرف الطراز مطلوب.',
            'model_id.integer' => 'يجب أن يكون معرف الطراز عددًا صحيحًا.',
            'model_id.exists' => 'معرف الطراز غير موجود.',
            'store_id.required' => 'حقل معرف المتجر مطلوب.',
            'store_id.integer' => 'يجب أن يكون معرف المتجر عددًا صحيحًا.',
            'store_id.exists' => 'معرف المتجر غير موجود.',
            'price.required' => 'حقل السعر مطلوب.',
            'price.numeric' => 'يجب أن يكون السعر رقمًا.',
            'price.min' => 'يجب ألا يكون السعر أقل من 0.',
            'creation_country.required' => 'حقل بلد الصنع مطلوب.',
            'creation_country.string' => 'يجب أن يكون بلد الصنع نصًا.',
            'creation_country.max' => 'يجب ألا يتجاوز بلد الصنع 255 حرفًا.',
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
