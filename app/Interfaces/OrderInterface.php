<?php

namespace App\Interfaces;

use App\Filter\OrderFilter;
use App\Models\Order;

interface OrderInterface
{
    public function addOrder($data);

    public function updateOrder(Order $order, $data);

    public function deleteOrder(Order $order);

    public function showOrder(Order $order);

    public function indexOrder(OrderFilter $filters);
}
