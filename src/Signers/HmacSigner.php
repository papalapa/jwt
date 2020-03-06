<?php

namespace papalapa\jwt\Signers;

use papalapa\jwt\KeyStorage;

/**
 * Class HmacSigner
 *
 * @package papalapa\jwt\Signers
 */
abstract class HmacSigner extends BaseSigner
{
    /**
     * @param string     $data
     * @param KeyStorage $keyStorage
     *
     * @return string
     */
    public function sign(string $data, KeyStorage $keyStorage) : string
    {
        return hash_hmac($this->getAlgorithm(), $data, $keyStorage->getSecret(), true);
    }

    /**
     * @param string     $data
     * @param KeyStorage $keyStorage
     * @param string     $signature
     *
     * @return bool
     */
    public function verify(string $data, KeyStorage $keyStorage, string $signature) : bool
    {
        $hash = $this->sign($data, $keyStorage);

        return hash_equals($signature, $hash);
    }
}
