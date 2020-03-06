<?php

namespace papalapa\jwt\Exceptions;

use Throwable;

/**
 * Class UnknownAlgorithmException
 *
 * @package papalapa\jwt\Exceptions
 */
class UnknownAlgorithmException extends InvalidTokenException
{
    /**
     * UnknownAlgorithmException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'No algorithm specified in header information', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
