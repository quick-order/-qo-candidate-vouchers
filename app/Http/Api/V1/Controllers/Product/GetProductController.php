<?php

namespace App\Http\Api\V1\Controllers\Product;

use App\Models\Product;
use Illuminate\Routing\Controller;

class GetProductController extends Controller
{
    public function __invoke(Product $product) {
        return $product;
    }
}
