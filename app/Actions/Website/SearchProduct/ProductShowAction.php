<?php

namespace App\Actions\Website\SearchProduct;

use App\Repository\ProductRepository;

class ProductShowAction
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke($product)
    {
        return $this->productRepository->showProduct($product);
    }
}
