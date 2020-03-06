<?php

namespace papalapa\jwt\Signers;

use papalapa\jwt\Exceptions\OpensslException;
use papalapa\jwt\Exceptions\OpensslSignException;
use papalapa\jwt\Exceptions\OpensslVerifyException;
use papalapa\jwt\KeyStorage;

/**
 * Class OpensslSigner
 *
 * @package papalapa\jwt\Signers
 */
abstract class OpensslSigner extends BaseSigner
{
    /**
     * @param string     $data
     * @param KeyStorage $keyStorage
     *
     * @return string
     * @throws OpensslSignException
     * @throws OpensslException
     */
    public function sign(string $data, KeyStorage $keyStorage) : string
    {
        $success = openssl_sign($data, $signature, $keyStorage->getPrivateKey(), $this->getAlgorithm());
        openssl_free_key($keyStorage->getPrivateKey());

        if ($success) {
            return $signature;
        }

        throw new OpensslSignException();
    }

    /**
     * @param string     $data
     * @param KeyStorage $keyStorage
     * @param string     $signature
     *
     * @return bool
     * @throws OpensslVerifyException
     * @throws OpensslException
     */
    public function verify(string $data, KeyStorage $keyStorage, string $signature) : bool
    {
        $result = openssl_verify($data, $signature, $keyStorage->getPublicKey(), $this->getAlgorithm());
        openssl_free_key($keyStorage->getPublicKey());

        if ($result === -1) {
            throw new OpensslVerifyException();
        }

        return (bool)$result;
    }
}
