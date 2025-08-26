<?php

namespace App\Actions\Admin\Products;

use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductCreateAction
{
    use AuthorizesRequests;

    public function __construct(protected ProductRepository $productRepository) {}

    public function __invoke(ProductRequest $request)
    {
        $request_validated = $request->validated();
        try {
            $this->authorize('create', [Product::class, $request_validated]);
        }catch (AuthorizationException $e){
            return ApiResponseHelper::sendMessageResponse(($e->getMessage()),ApiResponseCodes::UNAUTHORIZED,false );

        }
        return $this->productRepository->addProduct($request_validated);
    }
}
