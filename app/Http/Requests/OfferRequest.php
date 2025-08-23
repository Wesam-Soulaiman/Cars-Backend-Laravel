<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OfferRequest extends FormRequest
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
        $offerId = $this->route('offer')?->id;
        if ($offerId) {
            return [
                'product_id' => 'nullable|exists:products,id',
                'final_price' => 'nullable|numeric|min:0',
                'start_time' => 'nullable|date|before:end_time',
                'end_time' => 'nullable|date|after:start_time',
            ];
        }

        return [
            'product_id' => 'required|exists:products,id',
            'final_price' => 'required|numeric|min:0',
            'start_time' => 'required|date|before:end_time',
            'end_time' => 'required|date|after:start_time',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'حقل المنتج مطلوب.',
            'product_id.exists' => 'المنتج المحدد غير موجود.',

            'final_price.required' => 'حقل السعر النهائي مطلوب.',
            'final_price.numeric' => 'يجب أن يكون السعر النهائي رقمًا.',
            'final_price.min' => 'يجب ألا يكون السعر النهائي أقل من 0.',

            'start_time.required' => 'حقل وقت البداية مطلوب.',
            'start_time.date' => 'يجب أن يكون وقت البداية تاريخًا صالحًا.',
            'start_time.before' => 'يجب أن يكون وقت البداية قبل وقت النهاية.',

            'end_time.required' => 'حقل وقت النهاية مطلوب.',
            'end_time.date' => 'يجب أن يكون وقت النهاية تاريخًا صالحًا.',
            'end_time.after' => 'يجب أن يكون وقت النهاية بعد وقت البداية.',
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
