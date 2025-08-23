<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\ColStoreFilter;
use App\Filter\StoreFilter;
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

    public function searchStore(StoreFilter $filters)
    {
        $this->scopes = ['withStoreAvailable' => []];
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
        }
        if (! is_null($filters->getAddress())) {
            $this->where('address', '%'.$filters->getAddress().'%', 'like');
        }
        $products = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
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

    public function indexStore(StoreFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
        }
        if (! is_null($filters->getNameAr())) {
            $this->where('name_ar', '%'.$filters->getNameAr().'%', 'like');
        }
        if (! is_null($filters->getId())) {
            $this->where('id', $filters->getId());
        }
        if (! is_null($filters->getAddress())) {
            $this->where('address', '%'.$filters->getAddress().'%', 'like');
        }
        $this->orderBy('id', 'DESC');
        $stores = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $pagination = [
            'total' => $stores->total(),
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
