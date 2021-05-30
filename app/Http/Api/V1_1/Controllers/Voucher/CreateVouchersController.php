<?php

namespace App\Http\Api\V1_1\Controllers\Voucher;

use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

/**
 * Class CreateVouchersController
 * @package App\Http\Api\V1_1\Controllers\Voucher
 */
class CreateVouchersController extends Controller
{
    /**
     * @param Order $order
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function __invoke(Order $order, Request $request): Response
    {
        $vouchers = $request->all();
        /**
         * TODO talk: Normally I would validate the whole array with '*.amount_original' => 'required|integer|min:0'
         * But then we would have duplicate rules in the code which I don't like so without knowing you all and
         * standards I did the following below to keep the rules in one place on the Voucher model
         */
        DB::beginTransaction();
        try {
            foreach ($vouchers as $voucher) {
                $voucher = new Voucher($voucher);
                $voucher->setOrderId($order->id);
                $voucher->saveOrFail();
            }
        } catch (ValidationException $e) {
            DB::rollback();

            return response()->noContent(Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        DB::commit();

        // TODO talk: Do we need the inserted ID's back ? The order and vouchers is already linked here

        return response()->noContent(Response::HTTP_CREATED);
    }
}
