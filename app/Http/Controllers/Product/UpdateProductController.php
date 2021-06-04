<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UpdateProductController extends Controller
{
    public function __invoke(Product $product, Request $request) {

        $product->update($request->all());

        return $product->fresh();

    }
}
