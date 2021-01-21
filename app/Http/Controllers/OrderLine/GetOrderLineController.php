<?php

namespace App\Http\Controllers\OrderLine;

use App\Models\OrderLine;
use Illuminate\Routing\Controller;

class GetOrderLineController extends Controller
{
    public function __invoke(OrderLine $orderLine) {
        return $orderLine;
    }
}
