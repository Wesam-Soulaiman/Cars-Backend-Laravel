<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\PaginationFilter;
use App\Http\Resources\OfferResource;
use App\Interfaces\OfferInterface;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

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
        $this->scopes = ['activeOffer' => []];
        $this->with('product');
        $offers = $this->paginate($per_page, ['*'], 'page', $page);
        $pagination = [
            'total' => $offers->total(),
            'current_page' => $offers->currentPage(),
            'last_page' => $offers->lastPage(),
            'per_page' => $offers->perPage(),
        ];
        $offers = OfferResource::collection($offers);

        return ApiResponseHelper::sendResponseWithPagination(new Result($offers, 'get offer successfully', $pagination));
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
