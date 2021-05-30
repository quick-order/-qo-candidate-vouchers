<?php

namespace App\Facades\Token;

use Illuminate\Support\Facades\Facade;

/**
 * Class TokenClassFacade
 * @package App\Facades\Token
 */
class TokenClassFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'tokenclass';
    }
}
