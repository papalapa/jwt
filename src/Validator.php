<?php

namespace papalapa\jwt;

use papalapa\jwt\Exceptions\IncorrectJsonFormatException;
use papalapa\jwt\Exceptions\UnsupportedAlgorithmException;
use papalapa\jwt\Signers\SignerContract;

/**
 * Class Validator
 *
 * @package papalapa\jwt
 */
abstract class Validator
{
    /**
     * @var string
     */
    private $audience;

    /**
     * @var KeyStorage
     */
    private $keyStorage;

    /**
     * @var PayloadOptions
     */
    private $payloadOptions;

    /**
     * Supported signers
     */
    private $signers = [
        'HS256' => Signers\HS256::class,
        'HS384' => Signers\HS384::class,
        'HS512' => Signers\HS512::class,
        'RS256' => Signers\RS256::class,
        'RS384' => Signers\RS384::class,
        'RS512' => Signers\RS512::class,
    ];

    /**
     * Validator constructor.
     *
     * @param string              $audience
     * @param KeyStorage          $keyStorage
     * @param PayloadOptions|null $payloadOptions
     */
    final public function __construct(string $audience, KeyStorage $keyStorage, PayloadOptions $payloadOptions = null)
    {
        $this->audience = $audience;
        $this->keyStorage = $keyStorage;
        $this->payloadOptions = $payloadOptions ?? new PayloadOptions();
    }

    /**
     * @param string         $type
     * @param SignerContract $signer
     */
    final public function addSigner(string $type, SignerContract $signer) : void
    {
        $this->signers[$type] = $signer;
    }

    /**
     * @param string $type
     *
     * @return SignerContract|null
     */
    final public function getSigner(string $type) : ?SignerContract
    {
        if (array_key_exists($type, $this->signers)) {
            return $this->signers[$type];
        }

        return null;
    }

    /**
     * @param string $type
     */
    final public function removeSigner(string $type) : void
    {
        if (array_key_exists($type, $this->signers)) {
            unset($this->signers[$type]);
        }
    }

    /**
     * @return array
     */
    final public function getSigners() : array
    {
        return $this->signers;
    }

    /**
     * @param array $signers
     */
    final public function setSigners(array $signers) : void
    {
        $this->signers = [];
        foreach ($signers as $type => $concrete) {
            if (is_string($type) && $concrete instanceof SignerContract) {
                $this->signers[$type] = $concrete;
            }
        }
    }

    /**
     * @return void
     */
    final public function removeSigners() : void
    {
        $this->signers = [];
    }

    /**
     * @param string $input
     *
     * @return string
     */
    final public function base64UrlEncode(string $input) : string
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
     * @param string $input
     *
     * @return string
     */
    final public function base64UrlDecode(string $input) : string
    {
        if ($remainder = strlen($input) % 4) {
            $padLength = 4 - $remainder;
            $input .= str_repeat('=', $padLength);
        }

        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * @param array $data
     *
     * @return string
     * @throws IncorrectJsonFormatException
     */
    final public function toJson(array $data) : string
    {
        $json = json_encode($data);

        if ($errno = json_last_error()) {
            throw new IncorrectJsonFormatException('Could not encode to JSON', $errno);
        }

        return $json;
    }

    /**
     * @param string $data
     *
     * @return array
     * @throws IncorrectJsonFormatException
     */
    final public function fromJson(string $data) : array
    {
        $json = json_decode($data, true);

        if (!is_array($json) || $errno = json_last_error()) {
            throw new IncorrectJsonFormatException('Could not decode JSON', $errno ?? 0);
        }

        return $json;
    }

    /**
     * @return string
     */
    final protected function getAudience() : string
    {
        return $this->audience;
    }

    /**
     * @return KeyStorage
     */
    final protected function getKeyStorage() : KeyStorage
    {
        return $this->keyStorage;
    }

    /**
     * @return PayloadOptions
     */
    final protected function getPayloadOptions() : PayloadOptions
    {
        return $this->payloadOptions;
    }

    /**
     * @param string $algorithm
     *
     * @return SignerContract
     * @throws UnsupportedAlgorithmException
     */
    final protected function ensureSigner(string $algorithm) : SignerContract
    {
        if (array_key_exists($algorithm, $this->signers)) {
            return new $this->signers[$algorithm]();
        }

        throw new UnsupportedAlgorithmException();
    }
}
