<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\ProductFilter;
use App\Http\Resources\ProductDetailsResource;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Models\ProductFeatures;
use Illuminate\Support\Facades\Auth;

class ProductRepository extends BaseRepositoryImplementation implements ProductInterface
{
    public function __construct(protected ProductPhotosRepository $productPhotosRepository)
    {
        parent::__construct();

    }

    public function model()
    {
        return Product::class;
    }

    public function addProduct($data)
    {
        $product = $this->create($data);
        if (! empty($data['features'])) {
            $features = [];
            foreach ($data['features'] as $featureName) {
                $features[] = [
                    'feature_id' => $featureName,
                    'product_id' => $product->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            ProductFeatures::insert($features);
        }

        if (! empty($data['photos'])) {
            $this->productPhotosRepository->addProductPhotos($product->id, $data['photos']);

        }

        return ApiResponseHelper::sendResponse(new Result($product), ApiResponseCodes::CREATED);
    }

    public function updateProduct(Product $product, $data)
    {
        if (isset($data['main_photo']) && $data['main_photo']) {
            deleteImage($product->main_photo);
        }
        ProductFeatures::where('product_id', $product->id)->delete();
        if (! empty($data['features'])) {
            $features = [];
            foreach ($data['features'] as $featureName) {
                $features[] = [
                    'feature_id' => $featureName,
                    'product_id' => $product->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            ProductFeatures::insert($features);
        }

        $newProduct = $this->updateByIdWithNullableValues($product->id, $data);
        if (! empty($data['photos'])) {
            $this->productPhotosRepository->updateProductPhotos($product->id, $data['photos']);

        }

        return ApiResponseHelper::sendResponse(new Result($newProduct));

    }

    public function deleteProduct(Product $product)
    {
        $this->productPhotosRepository->DeleteProductPhotos($product->id);
        $this->deleteById($product->id);
        deleteImage($product->main_photo);

        return ApiResponseHelper::sendMessageResponse('delete product  successfully');
    }

    public function showProduct($id)
    {
        $percentagePrice = 1000;
        $this->with(['brand', 'model', 'store']);
        $product = $this->getById($id);
        $this->scopes = ['getProductAvailable' => []];
        $ProductPrice = $this->where('model_id', $product->model_id)
            ->where('brand_id', $product->brand_id)
            ->where('year_of_construction', $product->year_of_construction)
            ->get(['final_price']);
        $checkPrice = [
            'minPrice' => $ProductPrice->min('final_price'),
            'maxPrice' => $ProductPrice->max('final_price'),
            'averagePrice' => $ProductPrice->avg('final_price'),
            'price' => $product->final_price,
        ];
        $ProductDetail = ProductDetailsResource::make($product);
        $ProductsSimilar = Product::getProductAvailable()->having('final_price', '>=', $product->final_price - $percentagePrice)
            ->having('final_price', '<=', $product->final_price + $percentagePrice)
            ->where('products.id', '!=', $id)
            ->inRandomOrder()
            ->limit(6)
            ->get();
        $ProductsSimilarPrice = ProductResource::collection($ProductsSimilar);

        $data = [
            'productDetail' => $ProductDetail,
            'checkPrice' => $checkPrice,
            'ProductsSimilarPrice' => $ProductsSimilarPrice,

        ];

        return ApiResponseHelper::sendResponse(new Result($data, 'get details successfully'));

    }

    public function indexProduct(ProductFilter $filters)
    {
        $authStore = Auth::guard('store')->check();
        $this->with = ['brand', 'model'];
        if (! is_null($filters->getMaxPrice())) {
            $this->scopes['filterMaxPrice'] = [$filters->getMaxPrice()];
        }
        if (! is_null($filters->getMinPrice())) {
            $this->scopes['filterMinPrice'] = [$filters->getMinPrice()];
        }

        if (! is_null($filters->getBrandId())) {
            $this->where('brand_id', $filters->getBrandId());
        }
        if (! is_null($filters->getModelId())) {
            $this->where('model_id', $filters->getModelId());
        }
        if (! is_null($filters->getId())) {
            $this->where('id', $filters->getId());
        }
        if (! is_null($filters->getStructureId())) {
            $this->where('structure_id', $filters->getStructureId());
        }
        if (! is_null($filters->getFuelType())) {
            $this->where('fuel_type', $filters->getFuelType());
        }
        if (! is_null($filters->getStoreId()) && ! $authStore) {
            $this->where('products.store_id', $filters->getStoreId());
        }

        if (! is_null($filters->getMinYear())) {
            $this->where('year_of_construction', $filters->getMinYear(), '>=');
        }

        if (! is_null($filters->getMaxYear())) {
            $this->where('year_of_construction', $filters->getMaxYear(), '<=');
        }
        if (! is_null($filters->getType())) {
            $this->where('type', $filters->getType());
        }
        if ($authStore) {
            $this->where('store_id', Auth::guard('store')->id());
        }
        $this->orderBy('id', 'DESC');
        $products = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $pagination = [
            'total_page' => $products->total(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
        ];
        $products = ProductResource::collection($products->items());

        return ApiResponseHelper::sendResponseWithPagination(new Result($products, 'get products successfully', $pagination));
    }

    public function SearchProducts(ProductFilter $filters)
    {

        $this->scopes = ['getProductAvailable' => []];
        $this->with = ['activeOffer', 'store'];
        if (! is_null($filters->getMaxPrice())) {
            $this->scopes['filterMaxPrice'] = [$filters->getMaxPrice()];
        }
        if (! is_null($filters->getMinPrice())) {
            $this->scopes['filterMinPrice'] = [$filters->getMinPrice()];
        }

        if (! is_null($filters->getBrandId())) {
            $this->where('brand_id', $filters->getBrandId());
        }
        if (! is_null($filters->getStructureId())) {
            $this->where('structure_id', $filters->getStructureId());
        }
        if (! is_null($filters->getFuelType())) {
            $this->where('fuel_type', $filters->getFuelType());
        }
        if (! is_null($filters->getStoreId())) {
            $this->where('products.store_id', $filters->getStoreId());
        }

        if (! is_null($filters->getModelId())) {
            $this->where('model_id', $filters->getModelId());
        }
        if (! is_null($filters->getLights())) { // Added for lights
            $this->where('lights', $filters->getLights());
        }
        if (! is_null($filters->getMinYear())) {
            $this->where('year_of_construction', $filters->getMinYear(), '>=');
        }

        if (! is_null($filters->getMaxYear())) {
            $this->where('year_of_construction', $filters->getMaxYear(), '<=');
        }
        if (! is_null($filters->getType())) {
            $this->where('type', $filters->getType());
        }
        if (! is_null($filters->getOrder()) && ! is_null($filters->getOrderBy())) {
            $this->orderBy($filters->orderBy, $filters->order);
        }
        $products = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $pagination = [
            'total_page' => $products->total(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
        ];
        $products = ProductResource::collection($products->items());

        return ApiResponseHelper::sendResponseWithPagination(new Result($products, 'get products successfully', $pagination));

    }

    public function GetOneProduct(Product $product)
    {
        $this->with(['brand', 'model', 'store']);
        $showProduct = $this->getById($product->id);

        $ProductDetail = ProductDetailsResource::make($showProduct);

        return ApiResponseHelper::sendResponse(new Result($ProductDetail, 'get details successfully'));

    }

    public function productSpecial()
    {
        $this->scopes = ['getProductTopResult' => []];
        $products = $this->limit(6)->get();

        return ProductResource::collection($products);

    }

    public function productCountAvailable()
    {
        $this->scopes = ['getProductAvailable' => []];

        return $this->count();
    }

    public function productCount()
    {
        if (Auth::guard('store')->check()) {
            $this->where('store_id', Auth::guard('store')->id());
        }

        return $this->count();
    }

    public function getMonthlyProduct()
    {
        return Product::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as store_count')->groupBy('month')->orderBy('month')->get();
    }
}
