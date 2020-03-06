<?php

namespace papalapa\jwt\Exceptions;

/**
 * Class BaseException
 *
 * @package papalapa\jwt\Exceptions
 */
class BaseException extends \RuntimeException
{
    /**
     * BaseException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'JWT Token base exception', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
