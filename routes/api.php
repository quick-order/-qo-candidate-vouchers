<?php

use Illuminate\Support\Facades\Route;
use App\Http\Api\V1\Controllers as V1;
use App\Http\Api\V1_1\Controllers as V1_1;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1.1'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['middleware' => 'api.token'], function () {
            Route::post('register', [V1_1\User\AuthController::class, 'register']);
            Route::post('login', [V1_1\User\AuthController::class, 'login']);
        });
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::get('me', [V1_1\User\AuthController::class, 'me']);
        });
    });

    Route::group(['prefix' => 'vouchers', 'middleware' => ['auth:sanctum', 'role:customer']], function () {
        Route::post('order/{order}', V1_1\Voucher\CreateVouchersController::class);
    });
});

$baseVersions = ['', 'v1',];
foreach ($baseVersions as $baseVersion) {
    Route::prefix($baseVersion)->group(function () use ($baseVersion) {
        Route::prefix('orders')->group(function () {
            Route::get('', V1\Order\GetOrdersController::class);
            Route::post('', V1\Order\CreateOrderController::class);
            Route::patch('{order}', V1\Order\UpdateOrderController::class);
            Route::delete('{order}', V1\Order\DeleteOrderController::class);
            Route::get('{order}', V1\Order\GetOrderController::class);
            Route::prefix('{order}/order-lines')->group(function () {
                Route::get('', V1\OrderLine\GetOrderLinesByOrderController::class);
                Route::post('', V1\OrderLine\CreateOrderLineController::class);
                Route::patch('{order-line}', V1\OrderLine\UpdateOrderLineController::class);
                Route::delete('{order-line}', V1\OrderLine\DeleteOrderLineController::class);
                Route::get('{order-line}', V1\OrderLine\GetOrderLineController::class);
            });
        });

        Route::prefix('products')->group(function () {
            Route::get('', V1\Product\GetProductsController::class);
            Route::post('', V1\Product\CreateProductController::class);
            Route::patch('{product}', V1\Product\UpdateProductController::class);
            Route::delete('{product}', V1\Product\DeleteProductController::class);
            Route::get('{product}', V1\Product\GetProductController::class);
        });

        Route::prefix('vouchers')->group(function () {
            Route::get('', V1\Voucher\GetVouchersController::class);
            Route::post('', V1\Voucher\CreateVoucherController::class);
            Route::patch('{voucher}', V1\Voucher\UpdateVoucherController::class);
            Route::delete('{voucher}', V1\Voucher\DeleteVoucherController::class);
            Route::get('{voucher}', V1\Voucher\GetVoucherController::class);
        });
    });
}
