<?php

namespace papalapa\jwt\Exceptions;

use Throwable;

/**
 * Class UnsupportedAlgorithmException
 *
 * @package papalapa\jwt\Exceptions
 */
class UnsupportedAlgorithmException extends InconsistencyTokenException
{
    /**
     * UnsupportedAlgorithmException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'The algorithm specified in the header is not supported', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
