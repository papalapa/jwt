<?php

namespace App\Tests;

use papalapa\jwt\Decoder;
use papalapa\jwt\Encoder;
use papalapa\jwt\Exceptions\ActivationTimeException;
use papalapa\jwt\Exceptions\EmptyTokenPartsException;
use papalapa\jwt\Exceptions\ExpirationTimeException;
use papalapa\jwt\Exceptions\IncorrectJsonFormatException;
use papalapa\jwt\Exceptions\NotAllowedAudienceException;
use papalapa\jwt\Exceptions\NotVerifiedSignatureException;
use papalapa\jwt\Exceptions\OpensslException;
use papalapa\jwt\Exceptions\UnknownAlgorithmException;
use papalapa\jwt\Exceptions\UnsupportedAlgorithmException;
use papalapa\jwt\KeyStorage;
use papalapa\jwt\Signers\HS256;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    public function testEmptyTokenParts()
    {
        $this->expectException(EmptyTokenPartsException::class);

        $decoder = new Decoder('TEST', new KeyStorage(''));
        $token = 'X.Y';
        $decoder->decode($token);
    }

    public function testIncorrectJsonFormat()
    {
        $this->expectException(IncorrectJsonFormatException::class);

        $decoder = new Decoder('TEST', new KeyStorage(''));
        $token = 'X.Y.Z';
        $decoder->decode($token);
    }

    public function testUnknownAlgorithm()
    {
        $this->expectException(UnknownAlgorithmException::class);

        $decoder = new Decoder('TEST', new KeyStorage(''));
        $header = $decoder->base64UrlEncode($decoder->toJson((['typ' => 'JWT'])));
        $token = "{$header}.X.Y";
        $decoder->decode($token);
    }

    public function testUnsupportedAlgorithm()
    {
        $this->expectException(UnsupportedAlgorithmException::class);

        $decoder = new Decoder('TEST', new KeyStorage(''));
        $header = $decoder->base64UrlEncode($decoder->toJson((['typ' => 'JWT', 'alg' => 'DUMMY'])));
        $token = "{$header}.X.Y";
        $decoder->decode($token);
    }

    public function testNonVerifiedSignature()
    {
        $this->expectException(NotVerifiedSignatureException::class);

        $decoder = new Decoder('TEST', new KeyStorage(''));
        $header = $decoder->base64UrlEncode($decoder->toJson(['typ' => 'JWT', 'alg' => 'HS256']));
        $payload = $decoder->base64UrlEncode($decoder->toJson(['username' => 'John Doe']));
        $token = "{$header}.{$payload}.XYZ";
        $decoder->decode($token);
    }

    public function testActivation()
    {
        $this->expectException(ActivationTimeException::class);

        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $decoder = new Decoder('TEST', $keyStorage);
        $decoder->setActivationCheck(true);
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIiwibmJmIjoiMjEwMC0wMS0wMVQwMDowMDowMCJ9.vwewQPs_hRLXHUtjZe3CYykrq7-DXO3Tt53o1ADUObQ';
        $decoder->decode($token);
    }

    public function testExpiration()
    {
        $this->expectException(ExpirationTimeException::class);

        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $decoder = new Decoder('TEST', $keyStorage);
        $decoder->setExpirationCheck(true);
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIiwiZXhwIjoiMjAwMC0wMS0wMVQwMDowMDowMCJ9.tGs9vDMM8M5_OU_MgwF3oeluP2LuPxLxrL8NDR4iUcI';
        $decoder->decode($token);
    }

    public function testAudience()
    {
        $this->expectException(NotAllowedAudienceException::class);

        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $decoder = new Decoder('TEST', $keyStorage);
        $decoder->setAudienceCheck(true);
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIiwiYXVkIjpbIiF0ZXN0Il19.2JrJi4NW-hruL42WkB2JkpFqnJ3C4WVh4Dcf-ejyfnc';
        $decoder->decode($token);
    }

    public function testOpensslOnEmptyPublicKey()
    {
        $this->expectException(OpensslException::class);
        $this->expectExceptionMessage('Key Storage public key certificate is not set');

        $keyStorage = new KeyStorage('00000000000000000000000000000000', null, 'X');
        $keyStorage->getPublicKey();
    }

    public function testOpensslOnEmptyPrivateKey()
    {
        $this->expectException(OpensslException::class);
        $this->expectExceptionMessage('Key Storage private key certificate is not set');

        $keyStorage = new KeyStorage('00000000000000000000000000000000', 'X', null);
        $keyStorage->getPrivateKey();
    }

    public function testOpensslOnInaccessiblePublicKey()
    {
        $this->expectException(OpensslException::class);
        $this->expectExceptionMessage('Key Storage public key certificate is inaccessible');

        $keyStorage = new KeyStorage('00000000000000000000000000000000', 'X', null);
        $keyStorage->getPublicKey();
    }

    public function testOpensslOnInaccessiblePrivateKey()
    {
        $this->expectException(OpensslException::class);
        $this->expectExceptionMessage('Key Storage private key certificate is inaccessible');

        $keyStorage = new KeyStorage('00000000000000000000000000000000', null, 'X');
        $keyStorage->getPrivateKey();
    }

    public function testOpensslOnNonPemPublicKey()
    {
        $this->expectException(OpensslException::class);
        $this->expectExceptionMessage('Could not get public key from certificate file');

        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_EMPTY, JWT_EMPTY);
        $keyStorage->getPublicKey();
    }

    public function testOpensslOnNonPemPrivateKey()
    {
        $this->expectException(OpensslException::class);
        $this->expectExceptionMessage('Could not get private key from certificate file');

        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_EMPTY, JWT_EMPTY);
        $keyStorage->getPrivateKey();
    }

    public function testIncorrectJsonForEncoding()
    {
        $this->expectException(IncorrectJsonFormatException::class);
        $this->expectExceptionMessage('Could not encode to JSON');

        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $encoder = new Encoder('TEST', $keyStorage);

        $a1['a2'] = &$a2;
        $a2['a1'] = &$a1;

        $encoder->encode(new HS256(), $a1);
    }
}
