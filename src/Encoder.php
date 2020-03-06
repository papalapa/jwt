<?php

namespace papalapa\jwt;

use papalapa\jwt\Signers\SignerContract;

/**
 * Class Encoder
 *
 * @package papalapa\jwt
 */
class Encoder extends Validator
{
    /**
     * @param SignerContract $signer
     * @param array          $payload
     *
     * @return string
     * @throws Exceptions\IncorrectJsonFormatException
     * @throws Exceptions\OpensslException
     * @throws Exceptions\OpensslSignException
     */
    public function encode(SignerContract $signer, array $payload) : string
    {
        $header = ['typ' => 'JWT', 'alg' => $signer->getType()];
        $headerEncoded = $this->base64UrlEncode($this->toJson($header));
        $payloadEncoded = $this->base64UrlEncode($this->toJson($payload));

        $signature = $signer->sign($headerEncoded.'.'.$payloadEncoded, $this->getKeyStorage());
        $signatureEncoded = $this->base64UrlEncode($signature);

        return $headerEncoded.'.'.$payloadEncoded.'.'.$signatureEncoded;
    }
}
