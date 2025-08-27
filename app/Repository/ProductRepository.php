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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $store = Auth::guard('store')->user();

        return DB::transaction(function () use ($data, $store) {
            // Create the product
            $productData = $data;
            $productData['store_id'] = $store->id;
            $product = $this->create($productData);

            // Handle features
            if (!empty($data['features'])) {
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

            // Handle photos
            if (!empty($data['photos'])) {
                $this->productPhotosRepository->addProductPhotos($product->id, $data['photos']);
            }

            // Decrement remaining_count_product in the active order
            $activeOrder = \App\Models\Order::where('store_id', $store->id)
                ->where('active', true)
                ->where(function ($query) {
                    $query->whereNull('end_time')
                        ->orWhere('end_time', '>=', Carbon::now());
                })
                ->first();

            if ($activeOrder && $activeOrder->remaining_count_product !== null) {
                $activeOrder->decrement('remaining_count_product');
            }

            return ApiResponseHelper::sendResponse(new Result($product), ApiResponseCodes::CREATED);
        });
    }

    public function updateProduct(Product $product, $data)
    {

        if (isset($data['main_photo']) && $data['main_photo']) {
            deleteImage($product->main_photo);
        }
        ProductFeatures::where('product_id', $product->id)->delete();
        if (!empty($data['features'])) {
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
        if (!empty($data['photos'])) {
            $this->productPhotosRepository->updateProductPhotos($product->id, $data['photos']);
        }

        return ApiResponseHelper::sendResponse(new Result($newProduct));
    }

    public function deleteProduct(Product $product)
    {
        $this->productPhotosRepository->DeleteProductPhotos($product->id);
        $this->deleteById($product->id);
        deleteImage($product->main_photo);

        return ApiResponseHelper::sendMessageResponse('delete product successfully');
    }

    public function showProduct($id)
    {
        $percentagePrice = 1000;
        $this->with(['brand', 'model', 'store']);
        $product = $this->getById($id);
//        return $product;

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
        if (!is_null($filters->getMaxPrice())) {
            $this->scopes['filterMaxPrice'] = [$filters->getMaxPrice()];
        }
        if (!is_null($filters->getMinPrice())) {
            $this->scopes['filterMinPrice'] = [$filters->getMinPrice()];
        }

        if (!is_null($filters->getBrandId())) {
            $this->where('brand_id', $filters->getBrandId());
        }
        if (!is_null($filters->getModelId())) {
            $this->where('model_id', $filters->getModelId());
        }
        if (!is_null($filters->getId())) {
            $this->where('id', $filters->getId());
        }
        if (!is_null($filters->getStructureId())) {
            $this->where('structure_id', $filters->getStructureId());
        }
        if (!is_null($filters->getFuelType())) {
            $this->where('fuel_type', $filters->getFuelType());
        }
        if (!is_null($filters->getStoreId()) && !$authStore) {
            $this->where('products.store_id', $filters->getStoreId());
        }

        if (!is_null($filters->getMinYear())) {
            $this->where('year_of_construction', $filters->getMinYear(), '>=');
        }

        if (!is_null($filters->getMaxYear())) {
            $this->where('year_of_construction', $filters->getMaxYear(), '<=');
        }
        if (!is_null($filters->getType())) {
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

        $query = Product::getProductAvailable()
            ->with(['brand', 'model', 'store', 'color', 'fuel_type', 'gear', 'light', 'deal', 'structure', 'photos', 'activeOffer']);


        // Apply price filters
        if (!is_null($filters->getMinPrice())) {
            $query->having('final_price', '>=', $filters->getMinPrice());
        }
        if (!is_null($filters->getMaxPrice())) {
            $query->having('final_price', '<=', $filters->getMaxPrice());
        }

        // Apply schema-based filters
        if (!is_null($filters->getBrandId())) {
            $query->where('brand_id', $filters->getBrandId());
        }
        if (!is_null($filters->getStructureId())) {
            $query->where('structure_id', $filters->getStructureId());
        }
        if (!is_null($filters->getFuelTypeId())) {
            $query->where('fuel_type_id', $filters->getFuelTypeId());
        }
        if (!is_null($filters->getStoreId())) {
            $query->where('products.store_id', $filters->getStoreId());
        }
        if (!is_null($filters->getModelId())) {
            $query->where('model_id', $filters->getModelId());
        }
        if (!is_null($filters->getLightId())) {
            $query->where('light_id', $filters->getLightId());
        }
        if (!is_null($filters->getColorId())) {
            $query->where('color_id', $filters->getColorId());
        }
        if (!is_null($filters->getDealId())) {
            $query->where('deal_id', $filters->getDealId());
        }
        if (!is_null($filters->getCylinders())) {
            $query->where('cylinders', $filters->getCylinders());
        }
        if (!is_null($filters->getCylinderCapacity())) {
            $query->where('cylinder_capacity', $filters->getCylinderCapacity());
        }
        if (!is_null($filters->getDriveType())) {
            $query->where('drive_type', $filters->getDriveType());
        }
        if (!is_null($filters->getNumberOfSeats())) {
            $query->where('number_of_seats', $filters->getNumberOfSeats());
        }
        if (!is_null($filters->getSunroof())) {
            $query->where('sunroof', $filters->getSunroof());
        }
        if (!is_null($filters->getType())) {
            $query->where('type', $filters->getType());
        }
        if (!is_null($filters->getMinYear())) {
            $query->where('year_of_construction', '>=', $filters->getMinYear());
        }
        if (!is_null($filters->getMaxYear())) {
            $query->where('year_of_construction', '<=', $filters->getMaxYear());
        }
        if (!is_null($filters->getAdditionalFeatures())) {
            $query->where('additional_features', 'like', '%' . $filters->getAdditionalFeatures() . '%');
        }

        // Apply sorting
        if (!is_null($filters->getOrder()) && !is_null($filters->getOrderBy())) {
            $query->orderBy($filters->getOrderBy(), $filters->getOrder());
        }
//        dd($query);

        // Paginate results
        $startTime = microtime(true);
        $products = $query->paginate($filters->per_page, ['*'], 'page', $filters->page);

        $pagination = [
            'total_page' => $products->total(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
        ];

        $products = ProductResource::collection($products->items());
//        return $products;

        return ApiResponseHelper::sendResponseWithPagination(
            new Result($products, 'Get products successfully', $pagination)
        );
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
        return Product::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as store_count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

}
