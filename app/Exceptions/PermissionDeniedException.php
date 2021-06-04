<?php

namespace App\Exceptions;

use Exception;

/**
 * Class PermissionDeniedException
 * @package App\Exceptions
 */
class PermissionDeniedException extends Exception
{
    /**
     * PermissionDeniedException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(string $message, int $code = 403, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
