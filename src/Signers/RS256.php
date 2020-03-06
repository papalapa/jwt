<?php

namespace papalapa\jwt\Signers;

/**
 * Class RS256
 *
 * @package papalapa\jwt\Signers
 */
class RS256 extends OpensslSigner
{
    public const TYPE = 'RS256';

    public const ALGORITHM = 'SHA256';
}
