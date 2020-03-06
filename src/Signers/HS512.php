<?php

namespace papalapa\jwt\Signers;

/**
 * Class HS512
 *
 * @package papalapa\jwt\Signers
 */
class HS512 extends HmacSigner
{
    public const TYPE = 'HS512';

    public const ALGORITHM = 'SHA512';
}
