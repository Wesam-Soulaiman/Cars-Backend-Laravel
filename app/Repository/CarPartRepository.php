<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\CarPartFilter;
use App\Http\Resources\CarPartResource;
use App\Interfaces\CarPartInterface;
use App\Models\CarPart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarPartRepository extends BaseRepositoryImplementation implements CarPartInterface
{
    public function model()
    {
        return CarPart::class;
    }

    public function addCarPart($data)
    {
        $store = Auth::guard('store')->user();
        $data['store_id'] = $store->id;
        return DB::transaction(function () use ($data, $store) {


            $carPart = $this->create($data);

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

            return ApiResponseHelper::sendResponse(new Result($carPart), ApiResponseCodes::CREATED);
        });

    }

    public function updateCarPart(CarPart $carPart, $data)
    {
//        if (!$carPart) {
//            return ApiResponseHelper::sendResponse(
//                new Result(null, 'Car part not found.'), 404);
//
//        }
        $store = Auth::guard('store')->user();
        $data['store_id'] = $store->id;
        if (isset($data['main_photo']) && $data['main_photo']) {
            deleteImage($carPart->main_photo);
        }
        $newCarPart = $this->updateById($carPart->id, $data);
        return ApiResponseHelper::sendResponse(new Result($newCarPart));
    }

    public function deleteCarPart(CarPart $carPart)
    {
        $this->deleteById($carPart->id);
        return ApiResponseHelper::sendMessageResponse('delete car part successfully');
    }

    public function showCarPart(CarPart $carPart)
    {
        $showCarPart = $this->getById($carPart->id);
        return ApiResponseHelper::sendResponse(new Result(CarPartResource::make($showCarPart)));
    }


    public function getCarPartById($id)
    {
        $carPart = CarPart::getCarPartAvailable()
            ->with(['category', 'model', 'store' , 'brand'])
            ->where('car_parts.id', $id)
            ->first();
//        return $carPart;

        if (!$carPart) {
            return ApiResponseHelper::sendResponse(
                new Result([], 'Car part not found or not available.', 404),
                404
            );
        }

        return ApiResponseHelper::sendResponse(
            new Result(new CarPartResource($carPart), 'Get car part details successfully')
        );
    }


    public function indexCarPart(CarPartFilter $filters)
    {
        if (! is_null($filters->getCategoryId())) {
            $this->where('category_id', $filters->getCategoryId());
        }
        if (! is_null($filters->getModelId())) {
            $this->where('model_id', $filters->getModelId());
        }

        if (!is_null($filters->getBrandId())) {
            $this->where('brand_id', $filters->getBrandId());
        }

        if (! is_null($filters->getStoreId())) {
            $this->where('store_id', $filters->getStoreId());
        }
        if (! is_null($filters->getCreationCountry())) {
            $this->where('creation_country', '%'.$filters->getCreationCountry().'%', 'like');
        }
        $carParts = $this->paginate($filters->per_page, ['id', 'category_id', 'model_id','brand_id' ,  'store_id', 'price', 'creation_country'], 'page', $filters->page);
        $pagination = [
            'total' => $carParts->total(),
            'current_page' => $carParts->currentPage(),
            'last_page' => $carParts->lastPage(),
            'per_page' => $carParts->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result(CarPartResource::collection($carParts->items()), 'get car parts successfully', $pagination));
    }



    public function SearchCarParts(CarPartFilter $filters)
    {

        $query = CarPart::getCarPartAvailable()
            ->with(['category', 'model', 'store']);

        // Apply filters
        if (!is_null($filters->getId())) {
            $query->where('id', $filters->getId());
        }
        if (!is_null($filters->getCategoryId())) {
            $query->where('category_id', $filters->getCategoryId());
        }
        if (!is_null($filters->getModelId())) {
            $query->where('model_id', $filters->getModelId());
        }

        if (!is_null($filters->getBrandId())) {
            $query->where('brand_id', $filters->getBrandId());
        }

        if (!is_null($filters->getStoreId())) {
            $query->where('car_parts.store_id', $filters->getStoreId());
        }
        if (!is_null($filters->getMinPrice())) {
            $query->where('price', '>=', $filters->getMinPrice());
        }
        if (!is_null($filters->getMaxPrice())) {
            $query->where('price', '<=', $filters->getMaxPrice());
        }
        if (!is_null($filters->getCreationCountry())) {
            $query->where('creation_country', 'like', '%' . $filters->getCreationCountry() . '%');
        }

        // Apply sorting
        if (!is_null($filters->getOrderBy()) && !is_null($filters->getOrder())) {
            $query->orderBy($filters->getOrderBy(), $filters->getOrder());
        }

        // Paginate results
        $startTime = microtime(true);
        $carParts = $query->paginate($filters->per_page, ['*'], 'page', $filters->page);

        $pagination = [
            'total_page' => $carParts->total(),
            'current_page' => $carParts->currentPage(),
            'last_page' => $carParts->lastPage(),
            'per_page' => $carParts->perPage(),
        ];

        $carParts = CarPartResource::collection($carParts->items());

        return ApiResponseHelper::sendResponseWithPagination(
            new Result($carParts, 'Get car parts successfully', $pagination)
        );
    }


    public function CountCarPart()
    {
        $auth = Auth::guard('store')->check();
        if ($auth) {
            return Auth::user()->car_parts->count();
        }
        return $this->count();
    }
}
