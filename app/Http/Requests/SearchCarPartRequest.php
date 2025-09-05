<?php

namespace App\Http\Requests;

use App\Filter\CarPartFilter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchCarPartRequest extends FormRequest
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
            'category_id' => 'nullable|integer|exists:car_part_categories,id',
            'model_id' => 'nullable|integer|exists:models,id',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'store_id' => 'nullable|integer|exists:stores,id',
            'creation_country' => 'nullable|string',
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

    public function toFilter(): CarPartFilter
    {
        $filter = new CarPartFilter;
        if ($this->input('category_id') !== null) {
            $filter->setCategoryId($this->input('category_id'));
        }
        if ($this->input('model_id') !== null) {
            $filter->setModelId($this->input('model_id'));
        }

        if ($this->input('brand_id') !== null) {
            $filter->setBrandId($this->input('brand_id'));
        }

        if ($this->input('store_id') !== null) {
            $filter->setStoreId($this->input('store_id'));
        }
        if ($this->input('creation_country') !== null) {
            $filter->setCreationCountry($this->input('creation_country'));
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
