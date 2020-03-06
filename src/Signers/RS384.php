<?php

namespace papalapa\jwt\Signers;

/**
 * Class RS384
 *
 * @package papalapa\jwt\Signers
 */
class RS384 extends OpensslSigner
{
    public const TYPE = 'RS384';

    public const ALGORITHM = 'SHA384';
}
