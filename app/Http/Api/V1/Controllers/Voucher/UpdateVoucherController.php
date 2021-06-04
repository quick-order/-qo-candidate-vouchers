<?php

namespace App\Http\Api\V1\Controllers\Voucher;

use App\Models\Voucher;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UpdateVoucherController extends Controller
{
    public function __invoke(Voucher $voucher, Request $request) {

        $voucher->update($request->all());

        return $voucher->fresh();

    }
}
