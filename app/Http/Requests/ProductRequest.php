<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if (auth('store')->check()) {
            $this->merge([
                'store_id' => auth('store')->id(),
            ]);
        }
    }

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
        $productId = $this->route('product')?->id;
        $AuthStore = auth('store')->check();
        if ($productId) {
            $rules = [
                'location' => 'nullable|string|max:255',
                'brand_id' => 'nullable|exists:brands,id',
                'model_id' => 'nullable|exists:models,id',
                'structure_id' => 'nullable|integer',
                'main_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
                'price' => 'nullable|numeric|min:0',
                'mileage' => 'nullable|numeric|min:0',
                'year_of_construction' => 'nullable|integer',
                'number_of_seats' => 'nullable|integer|min:0',
                'drive_type' => 'nullable',
                'fuel_type' => 'nullable',
                'cylinders' => 'nullable|integer|min:0',
                'cylinder_capacity' => 'nullable|numeric',
                'gears' => 'nullable',
                'type' => 'nullable',
                'seat_type' => 'nullable',
                'sunroof' => 'nullable|boolean',
                'color' => 'nullable|string|max:50',
                'lights' => 'nullable|string|max:50',
                'photos' => 'nullable|array',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:3072',
                'features' => 'nullable|array',
                'features.*' => 'exists:features,id',
            ];
            if (! $AuthStore) {
                $rules['store_id'] = 'nullable|exists:stores,id';
            }

            return $rules;

        }

        $rules = [
            'location' => 'nullable|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'store_id' => 'required|exists:stores,id',
            'model_id' => 'required|exists:models,id',
            'structure_id' => 'required|integer',
            'main_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'price' => 'nullable|numeric|min:0',
            'mileage' => 'nullable|numeric|min:0',
            'year_of_construction' => 'required|integer',
            'register_year' => 'required|integer',
            'number_of_seats' => 'required|integer|min:0',
            'drive_type' => 'required',
            'fuel_type' => 'required',
            'cylinders' => 'required|integer|min:0',
            'cylinder_capacity' => 'required|numeric',
            'gears' => 'required',
            'type' => 'required',
            'seat_type' => 'required',
            'sunroof' => 'boolean',
            'color' => 'required|string|max:50',
            'lights' => 'required|string|max:50',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:3072',
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
        ];
        if (! $AuthStore) {
            $rules['store_id'] = 'required|exists:stores,id';
        }

        return $rules;

    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',

            'brand_id.required' => 'حقل الماركة مطلوب.',
            'brand_id.exists' => 'الماركة المحددة غير موجودة.',

            'store_id.required' => 'حقل المتجر مطلوب.',
            'store_id.exists' => 'المتجر المحدد غير موجود.',

            'model_id.required' => 'حقل الموديل مطلوب.',
            'model_id.exists' => 'الموديل المحدد غير موجود.',

            'structure_id.required' => 'حقل الهيكل مطلوب.',
            'structure_id.exists' => 'الهيكل المحدد غير موجود.',

            'main_photo.required' => 'حقل الصورة الرئيسية مطلوب.',
            'main_photo.image' => 'يجب أن تكون الصورة الرئيسية صورة.',
            'main_photo.mimes' => 'يجب أن تكون الصورة الرئيسية بامتداد: jpeg, png, jpg, gif.',
            'main_photo.max' => 'يجب ألا يتجاوز حجم الصورة الرئيسية 2 ميجابايت.',

            'price.required' => 'حقل السعر مطلوب.',
            'price.numeric' => 'يجب أن يكون السعر رقماً.',
            'price.min' => 'يجب أن يكون السعر أكبر من أو يساوي 0.',

            'mileage.required' => 'حقل المسافة المقطوعة مطلوب.',
            'mileage.numeric' => 'يجب أن تكون المسافة المقطوعة رقمًا.',
            'mileage.min' => 'يجب أن تكون المسافة المقطوعة أكبر من أو تساوي 0.',

            'year_of_construction.required' => 'حقل سنة البناء مطلوب.',
            'year_of_construction.integer' => 'يجب أن تكون سنة البناء عددًا صحيحًا.',

            'number_of_seats.required' => 'حقل عدد المقاعد مطلوب.',
            'number_of_seats.integer' => 'يجب أن يكون عدد المقاعد عددًا صحيحًا.',
            'number_of_seats.min' => 'يجب أن يكون عدد المقاعد أكبر من أو يساوي 0.',

            'drive_type.required' => 'حقل نوع الدفع مطلوب.',
            'drive_type.in' => 'نوع الدفع غير صالح.',

            'fuel_type.required' => 'حقل نوع الوقود مطلوب.',
            'fuel_type.in' => 'نوع الوقود غير صالح.',

            'cylinders.required' => 'حقل عدد الأسطوانات مطلوب.',
            'cylinders.integer' => 'يجب أن يكون عدد الأسطوانات عددًا صحيحًا.',
            'cylinders.min' => 'يجب أن يكون عدد الأسطوانات أكبر من أو يساوي 0.',

            'cylinder_capacity.required' => 'حقل سعة الأسطوانات مطلوب.',
            'cylinder_capacity.numeric' => 'يجب أن تكون سعة الأسطوانات رقمًا.',

            'gears.required' => 'حقل نوع التروس مطلوب.',
            'gears.in' => 'نوع التروس غير صالح.',

            'type.required' => 'حقل النوع مطلوب.',
            'type.in' => 'النوع غير صالح.',

            'seat_type.required' => 'حقل نوع المقعد مطلوب.',
            'seat_type.in' => 'نوع المقعد غير صالح.',

            'sunroof.boolean' => 'حقل السقف المفتوح يجب أن يكون صحيحًا أو خاطئًا.',

            'color.required' => 'حقل اللون مطلوب.',
            'color.string' => 'يجب أن يكون اللون نصًا.',
            'color.max' => 'يجب ألا يتجاوز اللون 50 حرفًا.',

            'lights.required' => 'حقل الأضواء مطلوب.',
            'lights.string' => 'يجب أن تكون الأضواء نصًا.',
            'lights.max' => 'يجب ألا تتجاوز الأضواء 50 حرفًا.',

            'photos.array' => 'حقل الصور يجب أن يكون مصفوفة.',
            'photos.*.image' => 'يجب أن تكون الصورة صورة.',
            'photos.*.mimes' => 'يجب أن تكون الصورة بامتداد: jpeg, png, jpg, gif.',
            'photos.*.max' => 'يجب ألا يتجاوز حجم الصورة 2 ميجابايت.',

            'features.array' => 'حقل الميزات يجب أن يكون مصفوفة.',
            'features.*.string' => 'يجب أن تكون الميزة نصًا.',
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
