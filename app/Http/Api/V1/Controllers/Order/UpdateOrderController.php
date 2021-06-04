<?php

namespace App\Http\Api\V1\Controllers\Order;

use App\Models\Order;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UpdateOrderController extends Controller
{
    public function __invoke(Order $order, Request $request) {

        $order->fill($request->all());

        $order->calculateTotal();

        $order->saveOrFail();

        return $order->fresh();

    }
}
