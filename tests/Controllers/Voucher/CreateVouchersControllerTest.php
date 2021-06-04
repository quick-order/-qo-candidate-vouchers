<?php

namespace Tests\Controllers\Voucher;

use App\Enums\UserRoleEnum;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class CreateVouchersControllerTest
 * @package Tests\Controllers\Voucher
 */
class CreateVouchersControllerTest extends TestCase
{
    private string $url = '/api/v1.1/vouchers/order';

    public function testCreateVouchers(): void
    {
        $order = factory(Order::class)->create();
        $voucher = factory(Voucher::class)->make();
        $payload = [
            [
                'amount_original' => $voucher->amount_original ?? 0,
                'amount_remaining' => $voucher->amount_remaining ?? 0,
            ],
            [
                'amount_original' => $voucher->amount_original ?? 0,
                'amount_remaining' => $voucher->amount_remaining ?? 0,
            ],
        ];
        Sanctum::actingAs(factory(User::class)->create(), [UserRoleEnum::CUSTOMER]);
        $this
            ->postJson(sprintf('%s/%d', $this->url, $order->id), $payload)
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function testCreateVouchersWithNoToken(): void
    {
        $order = factory(Order::class)->make();
        $this
            ->postJson(
                sprintf('%s/%d', $this->url, $order->id),
                []
            )
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }


    public function testCreateVouchersWithWrongUserRole(): void
    {
        $order = factory(Order::class)->create();
        Sanctum::actingAs(factory(User::class)->create(), [UserRoleEnum::GUEST]);
        $this
            ->postJson(
                sprintf('%s/%d', $this->url, $order->id),
                []
            )
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
