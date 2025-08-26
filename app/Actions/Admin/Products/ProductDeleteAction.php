<?php

namespace App\Actions\Admin\Products;

use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\Models\Product;
use App\Models\Store;
use App\Repository\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductDeleteAction
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke(Product $product)
    {
        $user = Auth::guard('store')->user();

        if ($user  instanceof Store && ! $user->can('delete', $product)) {
            return ApiResponseHelper::sendMessageResponse(('This action is unauthorized.'),ApiResponseCodes::UNAUTHORIZED,false );
        }

        return $this->productRepository->deleteProduct($product);
    }
}
