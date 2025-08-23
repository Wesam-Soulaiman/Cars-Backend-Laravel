<?php

namespace App\Actions\Website\SearchProduct;

use App\Http\Requests\SearchProductRequest;
use App\Repository\ProductRepository;

class ProductSearchAction
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke(SearchProductRequest $searchProductRequest)
    {
        return $this->productRepository->SearchProducts($searchProductRequest->toFilter());
    }
}
