<?php

namespace papalapa\jwt\Exceptions;

/**
 * Class NotAllowedAudienceException
 *
 * @package papalapa\jwt\Exceptions
 */
class NotAllowedAudienceException extends InconsistencyTokenException
{
    /**
     * NotAllowedAudienceException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'Token not allowed for current audience', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
