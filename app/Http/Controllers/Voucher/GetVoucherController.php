<?php

namespace App\Http\Controllers\Voucher;

use App\Models\Voucher;
use Illuminate\Routing\Controller;

class GetVoucherController extends Controller
{
    public function __invoke(Voucher $voucher) {
        return $voucher;
    }
}
