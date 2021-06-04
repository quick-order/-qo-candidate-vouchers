<?php

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

/**
 * Class OrderSeeder
 */
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!App::environment('production')) {
            factory(Order::class, 10)->create();
        }
    }
}
