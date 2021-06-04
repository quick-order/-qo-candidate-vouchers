<?php

namespace App\Exceptions;

use Exception;

/**
 * Class TokenMismatchException
 * @package App\Exceptions
 */
class TokenMismatchException extends Exception
{
    /**
     * TokenMissingException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(string $message, int $code = 401, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
