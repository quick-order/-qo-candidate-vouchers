<?php

namespace Tests\Controllers\Voucher;

use App\Models\Voucher;
use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * Class CreateVoucherControllerTest
 * @package Tests\Controllers\Voucher
 */
class CreateVoucherControllerTest extends TestCase
{
    private array $urls = [
        '/api/vouchers',
        '/api/v1/vouchers',
    ];

    public function testCreateVoucher(): void
    {
        $voucher = factory(Voucher::class)->make();
        $payload = [
            'amount_original' => $voucher->amount_original ?? 0,
            'amount_remaining' => $voucher->amount_remaining ?? 0,
        ];
        foreach ($this->urls as $url) {
            $this
                ->postJson($url, $payload)
                ->assertStatus(Response::HTTP_CREATED)
                ->assertJsonStructure([
                    'id',
                    'order_id',
                    'amount_original',
                    'amount_remaining',
                    'created_at',
                    'updated_at',
                ]);
        }
    }
}
