<?php

namespace App\Http\Requests;

use App\Filter\StoreFilter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchStoreRequest extends FormRequest
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
            'id' => 'nullable',
            'name' => 'nullable|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'page' => 'nullable',
            'per_page' => 'nullable',

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

    public function toFilter(): StoreFilter
    {
        $filter = new StoreFilter;
        if ($this->input('name') !== null) {
            $filter->setName($this->input('name'));
        }
        if ($this->input('name_ar') !== null) {
            $filter->setNameAr($this->input('name_ar'));
        }
        if ($this->input('id') !== null) {
            $filter->setId($this->input('id'));
        }
        if ($this->input('address') !== null) {
            $filter->setAddress($this->input('address'));
        }
        if ($this->input('page') !== null) {
            $filter->setPage($this->input('page'));
        }
        if ($this->input('per_page') !== null) {
            $filter->setPerPage($this->input('per_page'));
        }

        return $filter;
    }
}
