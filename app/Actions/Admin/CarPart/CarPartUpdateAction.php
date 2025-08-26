<?php

namespace App\Actions\Admin\CarPart;

use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\Http\Requests\CarPartRequest;
use App\Models\CarPart;
use App\Models\Store;
use App\Repository\CarPartRepository;
use Illuminate\Auth\Access\AuthorizationException;

class CarPartUpdateAction
{
    public function __construct(protected CarPartRepository $carPartRepository) {}

    public function __invoke(CarPart $carPart, CarPartRequest $carPartRequest)
    {
//        dd($carPart);
        if ($carPartRequest->user() instanceof Store && ! $carPartRequest->user()->can('update', $carPart)) {
            return ApiResponseHelper::sendMessageResponse(('This action is unauthorized.'),ApiResponseCodes::UNAUTHORIZED,false );
        }
        return $this->carPartRepository->updateCarPart($carPart, $carPartRequest->validated());
    }
}
