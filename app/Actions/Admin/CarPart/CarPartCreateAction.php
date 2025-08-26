<?php

namespace App\Actions\Admin\CarPart;

use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\Http\Requests\CarPartRequest;
use App\Models\CarPart;
use App\Repository\CarPartRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CarPartCreateAction
{
    use AuthorizesRequests;
    public function __construct(protected CarPartRepository $carPartRepository) {}

    public function __invoke(CarPartRequest $request)
    {
        $request_validated = $request->validated();
        try {
            $this->authorize('create', [CarPart::class, $request_validated]);
        }catch (AuthorizationException $e){
            return ApiResponseHelper::sendMessageResponse(($e->getMessage()),ApiResponseCodes::UNAUTHORIZED,false );
        }
        return $this->carPartRepository->addCarPart($request_validated);
    }
}
