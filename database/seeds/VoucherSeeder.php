<?php

use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

/**
 * Class VoucherSeeder
 */
class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!App::environment('production')) {
            factory(Voucher::class, 10)->create();
        }
    }
}
