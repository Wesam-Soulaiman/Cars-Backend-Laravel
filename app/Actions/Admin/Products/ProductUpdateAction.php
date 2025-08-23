<?php

namespace App\Actions\Admin\Products;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Store;
use App\Repository\ProductRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ProductUpdateAction
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke(Product $product, ProductRequest $request)
    {
        if ($request->user() instanceof Store && ! $request->user()->can('update', $product)) {
            throw new AuthorizationException('This action is unauthorized.');
        }

        return $this->productRepository->updateProduct($product, $request->validated());
    }
}
