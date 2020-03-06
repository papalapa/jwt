<?php

namespace papalapa\jwt\Exceptions;

use Throwable;

/**
 * Class OpensslSignException
 *
 * @package papalapa\jwt\Exceptions
 */
class OpensslSignException extends OpensslException
{
    /**
     * OpensslSignException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Unable to sign data using OpenSSL', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
