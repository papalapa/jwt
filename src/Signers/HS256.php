<?php

namespace papalapa\jwt\Signers;

/**
 * Class HS256
 *
 * @package papalapa\jwt\Signers
 */
class HS256 extends HmacSigner
{
    public const TYPE = 'HS256';

    public const ALGORITHM = 'SHA256';
}
