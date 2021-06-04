<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!App::environment('production')) {
            factory(User::class, 10)->create();
        }
    }
}
