<?php

namespace papalapa\jwt\Exceptions;

/**
 * Class InconsistencyTokenException
 *
 * @package papalapa\jwt\Exceptions
 */
class InconsistencyTokenException extends BaseException
{
    /**
     * InconsistencyTokenException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'JWT Token inconsistency', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
