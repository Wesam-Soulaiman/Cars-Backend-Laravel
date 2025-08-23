<?php

namespace App\Http\Requests;

use App\Filter\OrderFilter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchOrderRequest extends FormRequest
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
            'store_id' => 'nullable|integer',
            'service_id' => 'nullable|integer',
            'created_at' => 'nullable|date',
            'active' => 'nullable|bool',
            'order' => 'required_with:sort|in:asc,desc',
            'sort' => 'required_with:order|string|in:id,count_days,price',
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

    public function toFilter(): OrderFilter
    {
        $filter = new OrderFilter;
        if ($this->input('store_id') !== null) {
            $filter->setStoreId($this->input('store_id'));
        }
        if ($this->input('service_id') !== null) {
            $filter->setServiceId($this->input('service_id'));
        }
        if ($this->input('active') !== null) {
            $filter->setActive($this->input('active'));
        }
        if ($this->input('created_at') !== null) {
            $filter->setCreatedAt($this->input('created_at'));
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
