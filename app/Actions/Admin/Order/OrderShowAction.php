<?php

namespace App\Actions\Admin\Order;

use App\Models\Order;
use App\Repository\OrderRepository;

class OrderShowAction
{
    public function __construct(protected OrderRepository $orderRepository) {}

    public function __invoke(Order $order)
    {
        return $this->orderRepository->showOrder($order);
    }
}
