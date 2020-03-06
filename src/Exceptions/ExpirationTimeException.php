<?php

namespace papalapa\jwt\Exceptions;

/**
 * Class ExpirationTimeException
 *
 * @package papalapa\jwt\Exceptions
 */
class ExpirationTimeException extends InconsistencyTokenException
{
    /**
     * ExpirationTimeException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'Token is expired', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
