<?php

namespace papalapa\jwt\Signers;

/**
 * Class BaseSigner
 *
 * @package papalapa\jwt\Signers
 */
abstract class BaseSigner implements SignerContract
{
    /**
     * @inheritDoc
     */
    final public function getType() : string
    {
        return static::TYPE;
    }

    /**
     * @inheritDoc
     */
    final public function getAlgorithm() : string
    {
        return static::ALGORITHM;
    }
}
