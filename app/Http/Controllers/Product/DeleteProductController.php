<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Routing\Controller;

class DeleteProductController extends Controller
{
    public function __invoke(Product $product) {

        $product->delete();

        return response($product, 200);

    }
}
