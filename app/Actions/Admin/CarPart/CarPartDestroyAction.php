<?php

namespace App\Actions\Admin\CarPart;

use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\Models\CarPart;
use App\Models\Store;
use App\Repository\CarPartRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class CarPartDestroyAction
{
    public function __construct(protected CarPartRepository $carPartRepository) {}

    public function __invoke(CarPart $carPart)
    {
        $user = Auth::guard('store')->user();
        if ($user  instanceof Store && ! $user->can('delete', $carPart)) {
            return ApiResponseHelper::sendMessageResponse(('This action is unauthorized.'),ApiResponseCodes::UNAUTHORIZED,false );
        }
        return $this->carPartRepository->deleteCarPart($carPart);
    }
}
