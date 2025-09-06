<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\ColStoreFilter;
use App\Filter\StoreFilter;
use App\Http\Resources\CarPartResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StoreResource;
use App\Interfaces\StoreInterface;
use App\Models\Store;

class StoreRepository extends BaseRepositoryImplementation implements StoreInterface
{
    public function model()
    {
        return Store::class;
    }

    public function addStore($data)
    {
        $store = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($store), ApiResponseCodes::CREATED);
    }

    public function StoreCountAvailable()
    {
        $this->scopes = ['withStoreAvailable' => []];

        return $this->count();

    }

    public function StoreCount()
    {

        return $this->count();

    }

    public function searchStore(StoreFilter $filter)
    {

        $this->newQuery()->eagerLoad(); // Initialize the query

        if (! is_null($filter->getName())) {
            $this->where('name', '%'.$filter->getName().'%', 'like');
            $this->orWhere('name_ar', '%'.$filter->getName().'%', 'like');

        }

        if (! is_null($filter->getGovernorateId())) {
            $this->where('governorate_id',$filter->getGovernorateId());
        }
        $products = $this->paginate($filter->per_page, ['*'], 'page', $filter->page);
        $pagination = [
            'total_page' => $products->total(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
        ];
        $products = StoreResource::collection($products->items());

        return ApiResponseHelper::sendResponseWithPagination(new Result($products, 'get products successfully', $pagination));

    }

    public function updateStore(Store $store, $data)
    {
//        return $data;
        $newStore = $this->updateById($store->id, $data);
        if (isset($data['photo']) && $data['photo']) {
            deleteImage($store->photo);
        }

        return ApiResponseHelper::sendResponse(new Result($newStore));
    }

    public function deleteStore(Store $store)
    {
        $this->deleteById($store->id);
        deleteImage($store->photo);

        return ApiResponseHelper::sendMessageResponse('delete store  successfully');

    }

    public function showStore(Store $store)
    {
        $newStore = $this->getById($store->id);
        $newStore = StoreResource::make($newStore);

        return ApiResponseHelper::sendResponse(new Result($newStore, 'get store successfully'));

    }


    public function getStoreProduct(Store $store)
    {
        $newStore = $this->getById($store->id);
        $products = ProductResource::collection($newStore->products);

        return ApiResponseHelper::sendResponse(new Result($products, 'get store successfully'));

    }

    public function getStoreParts(Store $store)
    {
        $newStore = $this->getById($store->id);
        $products = CarPartResource::collection($newStore->car_parts);

        return ApiResponseHelper::sendResponse(new Result($products, 'get store successfully'));

    }

    public function indexStore(StoreFilter $filters)
    {
        $this->newQuery()->eagerLoad();

        if (! is_null($filters->getGovernorateId())) {
            $this->where('governorate_id', $filters->getGovernorateId());
        }
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
            $this->orWhere('name_ar', '%'.$filters->getName().'%', 'like');

        }
//        $this->orderBy('id', 'DESC');
        $stores = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $pagination = [
            'total_page' => $stores->total(),
            'current_page' => $stores->currentPage(),
            'last_page' => $stores->lastPage(),
            'per_page' => $stores->perPage(),
        ];
        $stores = StoreResource::collection($stores->items());

        return ApiResponseHelper::sendResponseWithPagination(new Result($stores, 'get store successfully', $pagination));
    }


    public function getColStore(ColStoreFilter $filters)
    {
        if (! is_null($filters->getValue())) {
            $this->where($filters->getCol(), '%'.$filters->getValue().'%', 'like');

        }

        $colStores = $this->paginate($filters->per_page, [$filters->getCol()], 'page', $filters->page);

        return ApiResponseHelper::sendResponse(new Result($colStores->items(), 'get Col store successfully'));
    }

    public function storeSpecial()
    {
        $this->scopes = ['withStoreTopResult' => []];

        $stores = $this->get();

        return StoreResource::collection($stores);

    }

    public function getmonthlyStores()
    {
        return Store::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as store_count')->groupBy('month')->orderBy('month')->get();

    }
}
