<?php

namespace App\Http\Controllers\OrderLine;

use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Routing\Controller;

class DeleteOrderLineController extends Controller
{
    public function __invoke(Order $order, OrderLine $orderLine) {

        $orderLine->delete();

        $order->calculateTotal();

        $order->saveOrFail();

        return response($orderLine, 200);
    }
}
