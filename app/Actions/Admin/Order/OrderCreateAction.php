<?php

namespace App\Actions\Admin\Order;

use App\Http\Requests\OrderRequest;
use App\Repository\OrderRepository;

class OrderCreateAction
{
    public function __construct(protected OrderRepository $orderRepository) {}

    public function __invoke(OrderRequest $request)
    {
        return $this->orderRepository->addOrder($request->validated());
    }
}
