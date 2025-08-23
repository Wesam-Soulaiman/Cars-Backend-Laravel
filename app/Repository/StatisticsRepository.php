<?php

namespace App\Repository;

use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Interfaces\StatisticsInterface;
use Illuminate\Support\Facades\Auth;

class StatisticsRepository implements StatisticsInterface
{
    public function __construct(protected ProductRepository $productRepository, protected StoreRepository $storeRepository, protected EmployeeRepository $employeeRepository, protected OfferRepository $offerRepository, protected OrderRepository $orderRepository) {}

    public function Statistics()
    {
        $countProduct = $this->productRepository->productCount();
        $CountOrder = $this->orderRepository->CountOrder();
        $countOffer = $this->offerRepository->CountOffer();
        if (Auth::guard('store')->check()) {
            $data = [
                'countProduct' => $countProduct,
                'countOffer' => $countOffer,
                'CountOrder' => $CountOrder,

            ];

            return ApiResponseHelper::sendResponse(new Result($data));

        }
        $countStore = $this->storeRepository->StoreCount();
        $monthlyProduct = $this->productRepository->getMonthlyProduct();
        $CountActiveOffer = $this->offerRepository->CountActiveOffer();
        $countActiveProduct = $this->productRepository->productCountAvailable();
        $countActiveStore = $this->storeRepository->StoreCountAvailable();
        $monthlyStores = $this->storeRepository->getmonthlyStores();
        $CountActiveOrder = $this->orderRepository->CountActiveOrder();
        $totalBills = $this->orderRepository->totalBills();
        $countEmployees = $this->employeeRepository->CountEmployees();
        $rolesCount = $this->employeeRepository->rolesCount();
        $SubscribedStoresCount = $this->orderRepository->SubscribedStoresCount();
        $getServicesCount = $this->orderRepository->getServicesCount();
        $monthlyOrders = $this->orderRepository->getmonthlyOrders();

        $data = [
            'countProduct' => $countProduct,
            'countActiveProduct' => $countActiveProduct,
            'countOffer' => $countOffer,
            'CountActiveOffer' => $CountActiveOffer,
            'countStore' => $countStore,
            'countActiveStore' => $countActiveStore,
            'CountOrder' => $CountOrder,
            'CountActiveOrder' => $CountActiveOrder,
            'totalBills' => $totalBills,
            'countEmployees' => $countEmployees,
            'SubscribedStoresCount' => $SubscribedStoresCount,
            'rolesCount' => $rolesCount,
            'getServicesCount' => $getServicesCount,
            'monthlyOrders' => $monthlyOrders,
            'monthlyStores' => $monthlyStores,
            'monthlyProduct' => $monthlyProduct,

        ];

        return ApiResponseHelper::sendResponse(new Result($data));
    }
}
