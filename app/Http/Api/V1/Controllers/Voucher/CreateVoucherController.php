<?php

namespace App\Http\Api\V1\Controllers\Voucher;

use App\Models\Voucher;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CreateVoucherController extends Controller
{
    public function __invoke(Request $request) {
        $voucher = new Voucher($request->all());

        $voucher->saveOrFail();

        return response()
            ->json(
                $voucher->fresh(),
                201
            );
    }
}
