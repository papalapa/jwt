<?php

namespace papalapa\jwt\Signers;

use papalapa\jwt\KeyStorage;

/**
 * Interface SignerContract
 *
 * @package papalapa\jwt\Signers
 */
interface SignerContract
{
    public const TYPE = '';

    public const ALGORITHM = '';

    /**
     * @param string     $data
     * @param KeyStorage $keyStorage
     *
     * @return string
     */
    public function sign(string $data, KeyStorage $keyStorage) : string;

    /**
     * @param string     $data
     * @param KeyStorage $keyStorage
     * @param string     $signature
     *
     * @return bool
     */
    public function verify(string $data, KeyStorage $keyStorage, string $signature) : bool;

    /**
     * @return string
     */
    public function getType() : string;

    /**
     * @return string
     */
    public function getAlgorithm() : string;
}
