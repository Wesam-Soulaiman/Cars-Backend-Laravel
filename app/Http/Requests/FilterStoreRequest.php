<?php

namespace App\Http\Requests;

use App\Filter\ColStoreFilter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterStoreRequest extends FormRequest
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
        return [
            'col' => 'required|in:name,name_ar,address,address_ar',
            'value' => 'nullable|string|max:255',

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

    public function toFilter(): ColStoreFilter
    {
        $filter = new ColStoreFilter;
        if ($this->input('col') !== null) {
            $filter->setCol($this->input('col'));
        }
        if ($this->input('value') !== null) {
            $filter->setValue($this->input('value'));
        }

        return $filter;
    }
}
