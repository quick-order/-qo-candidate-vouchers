<?php

namespace App\Http\Controllers\OrderLine;

use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UpdateOrderLineController extends Controller
{
    public function __invoke(Order $order, OrderLine $orderLine, Request $request) {

        $orderLine->update($request->all());

        $order->calculateTotal();

        $order->saveOrFail();

        return $orderLine->fresh();

    }
}
