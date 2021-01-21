<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use Illuminate\Routing\Controller;

class DeleteOrderController extends Controller
{
    public function __invoke(Order $order) {

        $order->delete();

        return response()->json($order, 200);

    }
}
