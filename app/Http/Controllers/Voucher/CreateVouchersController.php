<?php

namespace App\Http\Controllers\Voucher;

use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

/**
 * Class CreateVouchersController
 * @package App\Http\Controllers\Voucher
 */
class CreateVouchersController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function __invoke(Order $order, Request $request): JsonResponse
    {
        $vouchers = $request->all();
        /**
         * TODO talk: Normally I would validate the whole array with '*.amount_original' => 'required|integer|min:0'
         * But then we would have duplicate rules in the code which I don't like so without knowing you all and
         * standards I did the following below to keep the rules in one place on the Voucher model
         */
        $insertedVouchers = [];

        DB::beginTransaction();
        try {
            foreach ($vouchers as $voucher) {
                $voucher = new Voucher($voucher);
                $voucher->setOrderId($order->id);
                $voucher->saveOrFail();
                $insertedVouchers[] = $voucher->fresh();
            }
        } catch (ValidationException $e) {
            DB::rollback();

            return response()
                ->json(
                    $e->getMessage(),
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
        }
        DB::commit();

        // TODO talk: Do we need the inserted ID's back ? The order and vouchers is already linked here

        return response()
            ->json(
                $insertedVouchers,
                201
            );
    }
}
