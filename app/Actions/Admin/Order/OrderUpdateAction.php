<?php

namespace App\Actions\Admin\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Repository\OrderRepository;

class OrderUpdateAction
{
    public function __construct(protected OrderRepository $orderRepository) {}

    public function __invoke(Order $order, OrderRequest $request)
    {
        return $this->orderRepository->updateOrder($order, $request->validated());
    }
}
