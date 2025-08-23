<?php

namespace App\Actions\Admin\Products;

use App\Http\Requests\ProductRequest;
use App\Repository\ProductRepository;

class ProductCreateAction
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke(ProductRequest $request)
    {

        return $this->productRepository->addProduct($request->validated());
    }
}
