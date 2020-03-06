<?php

namespace papalapa\jwt;

use papalapa\jwt\Exceptions\OpensslException;

/**
 * Class KeyStorage
 *
 * @package papalapa\jwt
 */
class KeyStorage
{
    /**
     * Secret for sign
     *
     * @var string
     */
    private $secret;

    /**
     * Full real path for public key file
     *
     * @var string|null
     */
    private $cert;

    /**
     * Full real path for private key file
     *
     * @var string|null
     */
    private $key;

    /**
     * Password for certificate file
     *
     * @var string|null
     */
    private $passphrase;

    /**
     * KeyStorage constructor.
     *
     * @param string      $secret
     * @param string|null $cert
     * @param string      $key
     * @param string|null $passphrase
     */
    public function __construct(string $secret, string $cert = null, string $key = null, string $passphrase = null)
    {
        $this->secret = $secret;
        $this->cert = $cert;
        $this->key = $key;
        $this->passphrase = $passphrase;
    }

    /**
     * @return string
     */
    public function getSecret() : string
    {
        return $this->secret;
    }

    /**
     * @return resource
     * @throws OpensslException
     */
    public function getPublicKey()
    {
        $content = $this->getContent($this->cert, 'public key');
        $key = openssl_pkey_get_public($content);

        if ($key === false) {
            throw new OpensslException('Could not get public key from certificate file');
        }

        return $key;
    }

    /**
     * @return resource
     * @throws OpensslException
     */
    public function getPrivateKey()
    {
        $content = $this->getContent($this->key, 'private key');
        $key = openssl_pkey_get_private($content, $this->passphrase);

        if ($key === false) {
            throw new OpensslException('Could not get private key from certificate file');
        }

        return $key;
    }

    /**
     * @param string|null $path
     * @param string      $name
     *
     * @return false|string
     * @throws OpensslException
     */
    private function getContent(?string $path, string $name)
    {
        if ($path === null) {
            throw new OpensslException("Key Storage {$name} certificate is not set");
        }

        if (file_exists($path)  && is_readable($path) && is_file($path)) {
            return file_get_contents($path);
        }

        throw new OpensslException("Key Storage {$name} certificate is inaccessible");
    }
}
