<?php

namespace App\Http\Requests;

use App\Statuses\StoreStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
        $validTypes = implode(',', [StoreStatus::OFFICE, StoreStatus::GALLERY]);
        $storeId = $this->route('store')?->id;
        if ($storeId) {
            return [
                'name' => 'nullable|string|max:255',
                'name_ar' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'address_ar' => 'nullable|string|max:255',
                'email' => ['nullable', 'email', 'max:255', Rule::unique('stores')->ignore($storeId)],
                'password' => 'nullable|min:8|confirmed',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'phone' => 'nullable|string|max:20',
                'whatsapp_phone' => 'nullable|string|max:20',
                'type' => 'nullable|in:'.$validTypes,
                'governorate_id'=>'nullable|integer|exists:governorates,id',
                'store_type_id'=>'nullable|integer|exists:store_types,id',
            ];

        }

        return [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_ar' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:stores,email',
            'password' => 'required|min:8|confirmed',
            'photo' => 'image|mimes:jpg,jpeg,png|max:2048',
            'phone' => 'string|max:20',
            'whatsapp_phone' => 'string|max:20',
            'governorate_id'=>'required|integer|exists:governorates,id',
            'store_type_id'=>'required|integer|exists:store_types,id',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',

            'address.required' => 'حقل العنوان مطلوب.',
            'address.string' => 'يجب أن يكون العنوان نصًا.',
            'address.max' => 'يجب ألا يتجاوز العنوان 255 حرفًا.',

            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا.',
            'email.max' => 'يجب ألا يتجاوز البريد الإلكتروني 255 حرفًا.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',

            'password.required' => 'حقل كلمة المرور مطلوب.',
            'password.min' => 'يجب أن تكون كلمة المرور على الأقل 8 أحرف.',
            'password.confirmed' => 'تأكيد كلمة المرور غير مطابق.',

            'photo.image' => 'يجب أن تكون الصورة ملف صورة.',
            'photo.mimes' => 'يجب أن تكون الصورة بامتداد: jpg, jpeg, png.',
            'photo.max' => 'يجب ألا يتجاوز حجم الصورة 2048 كيلوبايت.',

            'phone.string' => 'يجب أن يكون رقم الهاتف نصًا.',
            'phone.max' => 'يجب ألا يتجاوز رقم الهاتف 20 حرفًا.',

            'whatsapp_phone.string' => 'يجب أن يكون رقم واتساب نصًا.',
            'whatsapp_phone.max' => 'يجب ألا يتجاوز رقم واتساب 20 حرفًا.',

            'latitude.numeric' => 'يجب أن يكون خط العرض رقمًا.',
            'latitude.between' => 'يجب أن يكون خط العرض بين -90 و 90.',

            'longitude.numeric' => 'يجب أن يكون خط الطول رقمًا.',
            'longitude.between' => 'يجب أن يكون خط الطول بين -180 و 180.',

            'type.required' => 'حقل النوع مطلوب.',
            'type.in' => 'النوع غير صالح.',
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
