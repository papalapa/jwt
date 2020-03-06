<?php

namespace papalapa\jwt\Exceptions;

use Throwable;

/**
 * Class NotVerifiedSignatureException
 *
 * @package papalapa\jwt\Exceptions
 */
class NotVerifiedSignatureException extends InvalidTokenException
{
    /**
     * NotVerifiedSignatureException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Signature is not verified', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
