<?php

namespace App\Providers;

use Illuminate\Routing\Matching\UriValidator;
use App\Validators\CustomUriValidator;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Class ApiVersioningServiceProvider
 * @package App\Providers
 */
class ApiVersioningServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $validators = Route::getValidators();
        $validators[] = new CustomUriValidator();
        Route::$validators = array_filter($validators, function ($validator) {
            return get_class($validator) !== UriValidator::class;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
