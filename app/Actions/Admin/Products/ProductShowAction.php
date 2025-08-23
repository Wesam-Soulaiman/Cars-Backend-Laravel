<?php

namespace App\Actions\Admin\Products;

use App\Models\Product;
use App\Repository\ProductRepository;

class ProductShowAction
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke(Product $product)
    {
        return $this->productRepository->GetOneProduct($product);
    }
}
