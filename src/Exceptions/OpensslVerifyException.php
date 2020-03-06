<?php

namespace papalapa\jwt\Exceptions;

use Throwable;

/**
 * Class OpensslVerifyException
 *
 * @package papalapa\jwt\Exceptions
 */
class OpensslVerifyException extends OpensslException
{
    /**
     * OpensslVerifyException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Unable to verify data using OpenSSL', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
