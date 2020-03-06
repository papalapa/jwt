<?php

namespace papalapa\jwt\Exceptions;

use Throwable;

/**
 * Class InvalidTokenException
 *
 * @package papalapa\jwt\Exceptions
 */
class InvalidTokenException extends BaseException
{
    /**
     * InvalidTokenException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'JWT Token is invalid', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
