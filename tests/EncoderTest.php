<?php

namespace App\Tests;

use papalapa\jwt\Encoder;
use papalapa\jwt\KeyStorage;
use papalapa\jwt\Signers\HS256;
use papalapa\jwt\Signers\HS384;
use papalapa\jwt\Signers\HS512;
use papalapa\jwt\Signers\RS256;
use papalapa\jwt\Signers\RS384;
use papalapa\jwt\Signers\RS512;
use PHPUnit\Framework\TestCase;

class EncoderTest extends TestCase
{
    public function testHS256()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.lv1XJ5-AKeciLPbEr0vV5XMgfdZMrUnK2t0GKkZapjU';

        $this->assertEquals($expectedToken, $encoder->encode(new HS256(), $payload));
    }

    public function testHS384()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzM4NCJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.sKLLITBQtZXKKd8gHW7m8zhopl0-zjIR1bVTeOSoGWQDy_U52xMtFqmfkT9uSyoL';

        $this->assertEquals($expectedToken, $encoder->encode(new HS384(), $payload));
    }

    public function testHS512()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.dqyXauLK6r5tx0iD5yRnFcQzPqUhYW06KQ16PRQ2Y0tv3RCkMD3pxB-0awzkQEzATcm4uwyguYa3z_0Arg_PkA';

        $this->assertEquals($expectedToken, $encoder->encode(new HS512(), $payload));
    }

    public function testRS256()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.1UQIpqFCaA_RphasLcaHQF9dYP1W7Hajv-f6IR1ZE3_BKC3JHPSZlIUS2UUIieryo3KXzoozAA31nNvFWxV2V2uCp_vMY9ZOJyqknaHe7yzUI-oezRec43eQjsNu-WvLDTfm8zLCk4tD7hvuKyMwJufB2XeiEhr7zqf54m3FqDPDnDoJdGPmvh2tOxW7v-L7pzoTd4tjCyj2rDRP-m6S9ynW7m2HnuakDAfvtIO2C24a8HrProope35mTdUdzakeVgC0SnL05OJoGPki9Dy11Td-UtcD93a0kJNKqgYOP4Y-X1HyF6A5JETM8yaWsTLLtY-qEcCsFpj8CTbljaDyWA';

        $this->assertEquals($expectedToken, $encoder->encode(new RS256(), $payload));
    }

    public function testRS384()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzM4NCJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.TmCLXyRrvilwplSog_4QG7SJeEM1O8__grWBrq67dW1M54FFBMsEpsFoMFoBORpeOoHAU3Z24EaluTuSiOKOqHX8EYMUtdVbrNDjMyjzUyHdcg47fJGQtP92aSCGZMd6vFVjK0GfOxLkbol-QnHfil4K2NwrcYCvYMHKEk-ogv0zX-fSAz9TVOQ6PKf7uBsuMDvpeql5V91ObC2-cROslHF-5BjSsLUrubn0guxT0cuiHjBOBdCD8T4uEnMPaV6hXg1Ewsg3_TV8-m_dzA50-cF1P_aCM9YtgsYCF4ft6cBAlPtxnypt9lxscRHAC0ukXkQvCaqhYSCcrdNeKWOzxQ';

        $this->assertEquals($expectedToken, $encoder->encode(new RS384(), $payload));
    }

    public function testRS512()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $encoder = new Encoder('TEST', $keyStorage);

        $payload = ['username' => 'John Doe'];
        $expectedToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.bHSzTttP1ycqZMWAl51lsYwr-uFc4CGDHhYABH8zzdE5sJVyPkKh-ksjiGyKTsWVbnpQDqIG3y794eCKkAiua1SyhV6nT27MpdDKfAJJqFAt8H1J9uc3Rjc_Xs7ZFy5rHo6qzxIjgn9CwksUeq7SpWbWXiWFx33c9FpNwyAucEE8sjkMDkiiJW3TJQJxESP1FTpSALknuYSJn82O9enIi8gsNmg-TSMlpr6STS5Fn4Qbc-Dz0mcvE_PUKLjXL5s1rlT2PWrP9lTWoM7HNcBT05LazE9ZFBwTkoKtHzQ9dPdIYCrNxBAekMEFm6HptWUfviRqURdyaS4d0Y2JmvnYuA';

        $this->assertEquals($expectedToken, $encoder->encode(new RS512(), $payload));
    }
}
