<?php

namespace papalapa\jwt\Exceptions;

/**
 * Class OpensslException
 *
 * @package papalapa\jwt\Exceptions
 */
class OpensslException extends BaseException
{
    /**
     * OpensslException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'Openssl exception', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
