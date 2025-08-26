<?php

namespace App\Actions\Admin\Products;

use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Store;
use App\Repository\ProductRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductUpdateAction
{
    use AuthorizesRequests;
    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke(Product $product, ProductRequest $request)
    {
        $request_validated = $request->validated();
        try {
//            if ($user  instanceof Store && ! $user->can('delete', $product)) {
            $this->authorize('update', [$product , $request_validated]);
        }catch (AuthorizationException $e){
            return ApiResponseHelper::sendMessageResponse(($e->getMessage()),ApiResponseCodes::UNAUTHORIZED,false );

        }
        return $this->productRepository->updateProduct($product, $request_validated);
    }
}
