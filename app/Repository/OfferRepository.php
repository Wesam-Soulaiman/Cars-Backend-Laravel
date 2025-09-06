<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\PaginationFilter;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OfferWithProductResource;
use App\Http\Resources\ProductResource;
use App\Interfaces\OfferInterface;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfferRepository extends BaseRepositoryImplementation implements OfferInterface
{
    public function model()
    {
        return Offer::class;
    }

    public function addOffer($data)
    {
        $offer = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($offer), ApiResponseCodes::CREATED);
    }

    public function updateOffer(Offer $offer, $data)
    {
        $newOffer = $this->updateById($offer->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newOffer));
    }

    public function deleteOffer(Offer $offer)
    {
        $this->deleteById($offer->id);

        return ApiResponseHelper::sendMessageResponse('delete offer  successfully');
    }

    public function showOffer(Offer $offer)
    {
        $showOffer = $this->getById($offer->id);

        $showOffer = OfferResource::make($showOffer);

        return ApiResponseHelper::sendResponse(new Result($showOffer, 'get offer successfully'));

    }

    public function activeOffer($page = 1, $per_page = 10)
    {
//        $this->scopes = ['activeOffer' => []];
//        $this->with('product');
//        $offers = $this->paginate($per_page, ['*'], 'page', $page);
//        $pagination = [
//            'total' => $offers->total(),
//            'current_page' => $offers->currentPage(),
//            'last_page' => $offers->lastPage(),
//            'per_page' => $offers->perPage(),
//        ];
//        $offers = OfferWithProductResource::collection($offers);
//
//        return ApiResponseHelper::sendResponseWithPagination(new Result($offers, 'get offer successfully', $pagination));
        $query = Product::query()
            ->join('offers', 'products.id', '=', 'offers.product_id')
            ->whereDate('offers.start_time', '<=', now())
            ->whereDate('offers.end_time', '>=', now())
            ->leftJoin('orders', function ($join) {
                $join->on('orders.store_id', '=', 'products.store_id')
                    ->whereDate('orders.start_time', '<=', now())
                    ->whereDate('orders.end_time', '>=', now())
                    ->where('orders.active', true)
                    ->whereExists(function ($subQuery) {
                        $subQuery->select(DB::raw(1))
                            ->from('services')
                            ->join('category_services', 'services.category_service_id', '=', 'category_services.id')
                            ->whereColumn('services.id', 'orders.service_id');
//                            ->where('category_services.name', 'subscription');
                    });
            })
            ->select('products.*')
            ->whereNotNull('orders.store_id')
            ->distinct();

        $results = $query->get();

        return ApiResponseHelper::sendResponse(
            new Result(ProductResource::collection($results), 'Products with active offers retrieved successfully')
        );
    }

    public function indexOffer(PaginationFilter $filters)
    {
        $authStore = Auth::guard('store')->check();
        $this->with('product');
        if ($authStore) {
            $this->scopes = ['forStore' => [Auth::guard('store')->id()]];
        }
        $offers = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $pagination = [
            'total' => $offers->total(),
            'current_page' => $offers->currentPage(),
            'last_page' => $offers->lastPage(),
            'per_page' => $offers->perPage(),
        ];
        $offers = OfferResource::collection($offers);

        return ApiResponseHelper::sendResponseWithPagination(new Result($offers, 'get offer successfully', $pagination));
    }

    public function CountOffer()
    {
        $auth = Auth::guard('store')->check();
        if ($auth) {
            return $count = Offer::join('products', 'offers.product_id', '=', 'products.id')
                ->where('products.store_id', Auth::guard('store')->id())
                ->count();
        }

        return $this->count();
    }

    public function CountActiveOffer()
    {
        $this->scopes = ['activeOffer' => []];

        return $this->count();
    }
}
