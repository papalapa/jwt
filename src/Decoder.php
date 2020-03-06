<?php

namespace papalapa\jwt;

use papalapa\jwt\Exceptions\ActivationTimeException;
use papalapa\jwt\Exceptions\EmptyTokenPartsException;
use papalapa\jwt\Exceptions\ExpirationTimeException;
use papalapa\jwt\Exceptions\IncorrectJsonFormatException;
use papalapa\jwt\Exceptions\NotAllowedAudienceException;
use papalapa\jwt\Exceptions\NotVerifiedSignatureException;
use papalapa\jwt\Exceptions\UnknownAlgorithmException;
use papalapa\jwt\Exceptions\UnsupportedAlgorithmException;
use papalapa\jwt\Signers\SignerContract;

/**
 * Class Decoder
 *
 * @package papalapa\jwt
 */
class Decoder extends Validator
{
    /**
     * @var bool
     */
    private $activationCheck = true;

    /**
     * @var bool
     */
    private $expirationCheck = true;

    /**
     * @var bool
     */
    private $audienceCheck = true;

    /**
     * @return bool
     */
    public function isActivationCheck() : bool
    {
        return $this->activationCheck;
    }

    /**
     * @param bool $activationCheck
     *
     * @return $this
     */
    public function setActivationCheck(bool $activationCheck) : self
    {
        $this->activationCheck = $activationCheck;

        return $this;
    }

    /**
     * @return bool
     */
    public function isExpirationCheck() : bool
    {
        return $this->expirationCheck;
    }

    /**
     * @param bool $expirationCheck
     *
     * @return $this
     */
    public function setExpirationCheck(bool $expirationCheck) : self
    {
        $this->expirationCheck = $expirationCheck;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAudienceCheck() : bool
    {
        return $this->audienceCheck;
    }

    /**
     * @param bool $audienceCheck
     *
     * @return $this
     */
    public function setAudienceCheck(bool $audienceCheck) : self
    {
        $this->audienceCheck = $audienceCheck;

        return $this;
    }

    /**
     * @param string $token
     *
     * @return array
     * @throws ActivationTimeException
     * @throws EmptyTokenPartsException
     * @throws ExpirationTimeException
     * @throws IncorrectJsonFormatException
     * @throws NotAllowedAudienceException
     * @throws NotVerifiedSignatureException
     * @throws UnknownAlgorithmException
     * @throws UnsupportedAlgorithmException
     */
    public function decode(string $token) : array
    {
        [$header, $payload, $signature] = $this->ensureParts($token);

        if (!$this->verify($header, $payload, $signature)) {
            throw new NotVerifiedSignatureException();
        }

        $payload = $this->fromJson($this->base64UrlDecode($payload));

        $this->isActivationCheck() && $this->checkActivation($payload);
        $this->isExpirationCheck() && $this->checkExpiration($payload);
        $this->isAudienceCheck() && $this->checkAudience($payload);

        return $payload;
    }

    /**
     * @param array $payload
     *
     * @throws ActivationTimeException
     */
    private function checkActivation(array $payload) : void
    {
        $nbfArgument = $this->getPayloadOptions()->getNbfArgument();
        if (array_key_exists($nbfArgument, $payload)) {
            $activationDatetime = new \DateTime($payload[$nbfArgument]);

            if ($activationDatetime > new \DateTime()) {
                throw new ActivationTimeException();
            }
        }
    }

    /**
     * @param array $payload
     *
     * @throws ExpirationTimeException
     */
    private function checkExpiration(array $payload) : void
    {
        $expArgument = $this->getPayloadOptions()->getExpArgument();
        if (array_key_exists($expArgument, $payload)) {
            $expirationDatetime = new \DateTime($payload[$expArgument]);

            if ($expirationDatetime < new \DateTime()) {
                throw new ExpirationTimeException();
            }
        }
    }

    /**
     * @param array $payload
     *
     * @throws NotAllowedAudienceException
     */
    private function checkAudience(array $payload) : void
    {
        $audArgument = $this->getPayloadOptions()->getAudArgument();
        if (array_key_exists($audArgument, $payload)) {
            if (!in_array($this->getAudience(), $payload[$audArgument], true)) {
                throw new NotAllowedAudienceException();
            }
        }
    }

    /**
     * @param string $token
     *
     * @return array
     * @throws EmptyTokenPartsException
     */
    private function ensureParts(string $token) : array
    {
        $emptyList = array_fill(0, 3, null);
        $tokenParts = explode('.', $token, 3);
        $parts = array_replace($emptyList, $tokenParts);

        if (in_array(null, $parts, true)) {
            throw new EmptyTokenPartsException();
        }

        return $parts;
    }

    /**
     * @param array $headerArray
     *
     * @return SignerContract
     * @throws UnknownAlgorithmException
     * @throws UnsupportedAlgorithmException
     */
    private function detectSigner(array $headerArray) : SignerContract
    {
        $argument = $this->getPayloadOptions()->getAlgArgument();
        if (array_key_exists($argument, $headerArray)) {
            return $this->ensureSigner($headerArray[$argument]);
        }

        throw new UnknownAlgorithmException();
    }

    /**
     * @param string $header
     * @param string $payload
     * @param string $signature
     *
     * @return bool
     * @throws IncorrectJsonFormatException
     * @throws UnknownAlgorithmException
     * @throws UnsupportedAlgorithmException
     */
    private function verify(string $header, string $payload, string $signature) : bool
    {
        $headerArray = $this->fromJson($this->base64UrlDecode($header));
        $signer = $this->detectSigner($headerArray);

        $data = $header.'.'.$payload;
        $signature = $this->base64UrlDecode($signature);

        return $signer->verify($data, $this->getKeyStorage(), $signature);
    }
}
