<?php

namespace App\Http\Requests;

use App\Filter\ProductFilter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchProductRequest extends FormRequest
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
            'id' => 'nullable|integer',
            'name' => 'nullable|string|max:255',
            'type' => 'nullable|numeric',
            'brand_id' => 'nullable|exists:brands,id',
            'model_id' => 'nullable|exists:models,id',
            'store_id' => 'nullable|exists:stores,id',
            'bodyType' => 'nullable|numeric',
            'fuel_type' => 'nullable|numeric',
            'structure_id' => 'nullable|integer', // Added for structure_id
            'lights' => 'nullable|string|max:255', // Added for lights
            'MaxPrice' => 'nullable|numeric|min:0',
            'MinPrice' => 'nullable|numeric|min:0',
            'minYear' => 'nullable',
            'maxYear' => 'nullable',
            'order' => 'required_with:sort|in:asc,desc',
            'sort' => 'required_with:order|string|in:id,final_price,mileage,year',
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

    public function toFilter(): ProductFilter
    {
        $filter = new ProductFilter;
        if ($this->input('id') !== null) {
            $filter->setId($this->input('id'));
        }
        if ($this->input('name') !== null) {
            $filter->setName($this->input('name'));
        }
        if ($this->input('type') !== null) {
            $filter->setType($this->input('type'));
        }
        if ($this->input('brand_id') !== null) {
            $filter->setBrandId($this->input('brand_id'));
        }
        if ($this->input('store_id') !== null) {
            $filter->setStoreId($this->input('store_id'));
        }
        if ($this->input('model_id') !== null) {
            $filter->setModelId($this->input('model_id'));
        }
        if ($this->input('bodyType') !== null) {
            $filter->setStructureId($this->input('bodyType'));
        }
        if ($this->input('fuel_type') !== null) {
            $filter->setFuelType($this->input('fuel_type'));
        }
        if ($this->input('structure_id') !== null) { // Added for structure_id
            $filter->setStructureId($this->input('structure_id'));
        }
        if ($this->input('lights') !== null) { // Added for lights
            $filter->setLights($this->input('lights'));
        }
        if ($this->input('MaxPrice') !== null) {
            $filter->setMaxPrice($this->input('MaxPrice'));
        }
        if ($this->input('MinPrice') !== null) {
            $filter->setMinPrice($this->input('MinPrice'));
        }
        if ($this->input('minYear') !== null) {
            $filter->setMinYear($this->input('minYear'));
        }
        if ($this->input('maxYear') !== null) {
            $filter->setMaxYear($this->input('maxYear'));
        }
        if ($this->input('page') !== null) {
            $filter->setPage($this->input('page'));
        }
        if ($this->input('per_page') !== null) {
            $filter->setPerPage($this->input('per_page'));
        }
        if ($this->input('order') !== null) {
            $filter->setOrder($this->input('order'));
        }
        if ($this->input('sort') !== null) {
            $filter->setOrderBy($this->input('sort'));
        }

        return $filter;
    }
}
