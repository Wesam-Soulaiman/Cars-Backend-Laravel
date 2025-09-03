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
            'brand_id' => 'nullable|integer|exists:brands,id',
            'store_id' => 'nullable|integer|exists:stores,id',
            'model_id' => 'nullable|integer|exists:models,id',
            'color_id' => 'nullable|integer|exists:colors,id',
            'fuel_type_id' => 'nullable|integer|exists:fuel_types,id',
            'gear_id' => 'nullable|integer|exists:gears,id',
            'light_id' => 'nullable|integer|exists:lights,id',
            'deal_id' => 'nullable|integer|exists:deals,id',
            'structure_id' => 'nullable|integer',
            'minPrice' => 'nullable|numeric|min:0',
            'maxPrice' => 'nullable|numeric|min:0',
            'mileage' => 'nullable|integer|min:0',
            'minYear' => 'nullable|integer|min:1900|max:'.date('Y'),
            'maxYear' => 'nullable|integer|min:1900|max:'.date('Y'),
            'minRegisterYear' => 'nullable|integer|min:1900|max:'.date('Y'),
            'maxRegisterYear' => 'nullable|integer|min:1900|max:'.date('Y'),
            'number_of_seats' => 'nullable|integer|min:1',
            'drive_type' => 'nullable|integer',
            'cylinders' => 'nullable|integer|min:1',
            'cylinder_capacity' => 'nullable|numeric|min:0',
            'creation_country' => 'nullable|string|max:255',
            'used' => 'nullable|boolean',
            'sunroof' => 'nullable|boolean',
            'type' => 'nullable|string',
            'order' => 'nullable|string|in:asc,desc',
            'orderBy' => 'nullable|string|in:id,price,year_of_construction,register_year,mileage',
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

    public function toFilter(): ProductFilter
    {
        $filter = new ProductFilter();
        if ($this->input('brand_id') !== null) {
            $filter->setBrandId($this->input('brand_id'));
        }
        if ($this->input('store_id') !== null) {
            $filter->setStoreId($this->input('store_id'));
        }
        if ($this->input('model_id') !== null) {
            $filter->setModelId($this->input('model_id'));
        }
        if ($this->input('color_id') !== null) {
            $filter->setColorId($this->input('color_id'));
        }
        if ($this->input('fuel_type_id') !== null) {
            $filter->setFuelTypeId($this->input('fuel_type_id'));
        }
        if ($this->input('gear_id') !== null) {
            $filter->setGearId($this->input('gear_id'));
        }
        if ($this->input('light_id') !== null) {
            $filter->setLightId($this->input('light_id'));
        }
        if ($this->input('deal_id') !== null) {
            $filter->setDealId($this->input('deal_id'));
        }
        if ($this->input('structure_id') !== null) {
            $filter->setStructureId($this->input('structure_id'));
        }
        if ($this->input('minPrice') !== null) {
            $filter->setMinPrice($this->input('minPrice'));
        }
        if ($this->input('maxPrice') !== null) {
            $filter->setMaxPrice($this->input('maxPrice'));
        }
        if ($this->input('mileage') !== null) {
            $filter->setMileage($this->input('mileage'));
        }
        if ($this->input('minYear') !== null) {
            $filter->setMinYear($this->input('minYear'));
        }
        if ($this->input('maxYear') !== null) {
            $filter->setMaxYear($this->input('maxYear'));
        }
        if ($this->input('minRegisterYear') !== null) {
            $filter->setMinRegisterYear($this->input('minRegisterYear'));
        }
        if ($this->input('maxRegisterYear') !== null) {
            $filter->setMaxRegisterYear($this->input('maxRegisterYear'));
        }
        if ($this->input('number_of_seats') !== null) {
            $filter->setNumberOfSeats($this->input('number_of_seats'));
        }
        if ($this->input('drive_type') !== null) {
            $filter->setDriveType($this->input('drive_type'));
        }
        if ($this->input('cylinders') !== null) {
            $filter->setCylinders($this->input('cylinders'));
        }
        if ($this->input('cylinder_capacity') !== null) {
            $filter->setCylinderCapacity($this->input('cylinder_capacity'));
        }
        if ($this->input('creation_country') !== null) {
            $filter->setCreationCountry($this->input('creation_country'));
        }
        if ($this->input('used') !== null) {
            $filter->setUsed($this->input('used'));
        }
        if ($this->input('sunroof') !== null) {
            $filter->setSunroof($this->input('sunroof'));
        }
        if ($this->input('type') !== null) {
            $filter->setType($this->input('type'));
        }
        if ($this->input('order') !== null) {
            $filter->setOrder($this->input('order'));
        }
        if ($this->input('orderBy') !== null) {
            $filter->setOrderBy($this->input('orderBy'));
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
