<?php

namespace App\Http\Controllers\Voucher;

use App\Models\Voucher;
use Illuminate\Routing\Controller;

class DeleteVoucherController extends Controller
{
    public function __invoke(Voucher $voucher) {

        $voucher->delete();

        return response($voucher, 200);

    }
}
