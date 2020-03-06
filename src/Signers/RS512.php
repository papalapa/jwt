<?php

namespace papalapa\jwt\Signers;

/**
 * Class RS512
 *
 * @package papalapa\jwt\Signers
 */
class RS512 extends OpensslSigner
{
    public const TYPE = 'RS512';

    public const ALGORITHM = 'SHA512';
}
