<?php

namespace App\Actions\Admin\Products;

use App\Http\Requests\SearchProductRequest;
use App\Repository\ProductRepository;

class ProductIndexAction
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke(SearchProductRequest $request)
    {
        return $this->productRepository->indexProduct($request->toFilter());
    }
}
