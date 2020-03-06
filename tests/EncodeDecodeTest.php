<?php

namespace App\Tests;

use papalapa\jwt\Decoder;
use papalapa\jwt\Encoder;
use papalapa\jwt\KeyStorage;
use papalapa\jwt\Signers\HS256;
use papalapa\jwt\Signers\HS384;
use papalapa\jwt\Signers\HS512;
use papalapa\jwt\Signers\RS256;
use papalapa\jwt\Signers\RS384;
use papalapa\jwt\Signers\RS512;
use PHPUnit\Framework\TestCase;

class EncodeDecodeTest extends TestCase
{
    public function testHS256()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $decoder = new Decoder('TEST', $keyStorage);
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($encoder->encode(new HS256(), $payload)));
    }

    public function testHS384()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $decoder = new Decoder('TEST', $keyStorage);
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($encoder->encode(new HS384(), $payload)));
    }

    public function testHS512()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $decoder = new Decoder('TEST', $keyStorage);
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($encoder->encode(new HS512(), $payload)));
    }

    public function testRS256()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $decoder = new Decoder('TEST', $keyStorage);
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($encoder->encode(new RS256(), $payload)));
    }

    public function testRS384()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $decoder = new Decoder('TEST', $keyStorage);
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($encoder->encode(new RS384(), $payload)));
    }

    public function testRS512()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $decoder = new Decoder('TEST', $keyStorage);
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($encoder->encode(new RS512(), $payload)));
    }
}
