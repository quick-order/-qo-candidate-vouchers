<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Routing\Controller;

class GetProductsController extends Controller
{
    public function __invoke() {
        return Product::all();
    }
}
