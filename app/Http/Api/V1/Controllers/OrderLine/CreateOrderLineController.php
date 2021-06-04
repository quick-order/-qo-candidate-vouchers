<?php

namespace App\Http\Api\V1\Controllers\OrderLine;

use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CreateOrderLineController extends Controller
{
    public function __invoke(Order $order, Request $request) {

        $orderLine = new OrderLine($request->all());

        $order->lines()->save($orderLine);

        $order->calculateTotal();

        $order->saveOrFail();

        return response()
            ->json(
                $orderLine->fresh(),
                201
            );
    }
}
