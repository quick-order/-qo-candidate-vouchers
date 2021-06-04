<?php

namespace App\Http\Controllers\OrderLine;

use App\Models\Order;
use Illuminate\Routing\Controller;

class GetOrderLinesByOrderController extends Controller
{
    public function __invoke(Order $order) {
        return response()->json($order->lines);
    }
}
