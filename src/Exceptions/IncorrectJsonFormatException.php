<?php

namespace papalapa\jwt\Exceptions;

/**
 * Class IncorrectJsonFormatException
 *
 * @package papalapa\jwt\Exceptions
 */
class IncorrectJsonFormatException extends InvalidTokenException
{
    /**
     * IncorrectJsonFormatException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'Incorrect JSON-formatted string encoded', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
