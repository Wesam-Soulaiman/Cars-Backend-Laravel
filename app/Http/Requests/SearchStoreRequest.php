<?php

namespace App\Http\Requests;

use App\Filter\StoreFilter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchStoreRequest extends FormRequest
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
        return [
            'name' => 'nullable|string',
            'governorate_id' => 'nullable|integer|exists:governorates,id',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1',
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
        if ($this->input('governorate_id') !== null) {
            $filter->setGovernorateId($this->input('governorate_id'));
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
