<?php

namespace App\Providers;

use App\Facades\Token\TokenClass;
use Illuminate\Support\ServiceProvider;

/**
 * Class TokenFacadesServiceProvider
 * @package App\Providers
 */
class TokenFacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('tokenclass', function () {
            return new TokenClass();
        });
    }
}
