<?php

namespace App\Actions\Admin\Products;

use App\Models\Product;
use App\Models\Store;
use App\Repository\ProductRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class ProductDeleteAction
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke(Product $product)
    {
        $user = Auth::guard('store')->user();

        if ($user  instanceof Store && ! $user->can('delete', $product)) {
            throw new AuthorizationException('This action is unauthorized.');
        }

        return $this->productRepository->deleteProduct($product);
    }
}
