<?php

namespace App\Actions\Admin\Order;

use App\Http\Requests\SearchOrderRequest;
use App\Repository\OrderRepository;

class OrderIndexAction
{
    public function __construct(protected OrderRepository $orderRepository) {}

    public function __invoke(SearchOrderRequest $request)
    {
        return $this->orderRepository->indexOrder($request->toFilter());
    }
}
