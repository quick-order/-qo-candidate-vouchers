<?php

namespace App\Http\Api\V1\Controllers\Order;

use App\Models\Order;
use Illuminate\Routing\Controller;

class GetOrdersController extends Controller
{
    public function __invoke() {
        return Order::all();
    }
}
