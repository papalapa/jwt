<?php

namespace papalapa\jwt\Signers;

/**
 * Class HS384
 *
 * @package papalapa\jwt\Signers
 */
class HS384 extends HmacSigner
{
    public const TYPE = 'HS384';

    public const ALGORITHM = 'SHA384';
}
