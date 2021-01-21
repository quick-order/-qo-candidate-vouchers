<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Routing\Controller;

class GetProductController extends Controller
{
    public function __invoke(Product $product) {
        return $product;
    }
}
