<?php

namespace App\Http\Api\V1\Controllers\Voucher;

use App\Models\Voucher;
use Illuminate\Routing\Controller;

class GetVouchersController extends Controller
{
    public function __invoke() {
        return Voucher::all();
    }
}
