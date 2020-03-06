<?php

namespace papalapa\jwt\Exceptions;

/**
 * Class ActivationTimeException
 *
 * @package papalapa\jwt\Exceptions
 */
class ActivationTimeException extends InconsistencyTokenException
{
    /**
     * ActivationTimeException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'The token is currently not working', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
