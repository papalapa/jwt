<?php

namespace papalapa\jwt\Exceptions;

/**
 * Class EmptyTokenPartsException
 *
 * @package papalapa\jwt\Exceptions
 */
class EmptyTokenPartsException extends InvalidTokenException
{
    /**
     * EmptyTokenPartsException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'Some of the token required parts is missing', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
