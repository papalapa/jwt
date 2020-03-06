<?php

namespace App\Tests;

use papalapa\jwt\Decoder;
use papalapa\jwt\KeyStorage;
use PHPUnit\Framework\TestCase;

class DecoderTest extends TestCase
{
    public function testHS256()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $decoder = new Decoder('TEST', $keyStorage);

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.lv1XJ5-AKeciLPbEr0vV5XMgfdZMrUnK2t0GKkZapjU';
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($token));
    }

    public function testHS384()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $decoder = new Decoder('TEST', $keyStorage);

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzM4NCJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.sKLLITBQtZXKKd8gHW7m8zhopl0-zjIR1bVTeOSoGWQDy_U52xMtFqmfkT9uSyoL';
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($token));
    }

    public function testHS512()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000');
        $decoder = new Decoder('TEST', $keyStorage);

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.dqyXauLK6r5tx0iD5yRnFcQzPqUhYW06KQ16PRQ2Y0tv3RCkMD3pxB-0awzkQEzATcm4uwyguYa3z_0Arg_PkA';
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($token));
    }

    public function testRS256()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $decoder = new Decoder('TEST', $keyStorage);

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.iG8EV3QD8Phbz9tpz7qsJi3NzR29wnay9Hrz-vJHemzWcgzlwUzFN-H79_a8tQ0I6-DwCSqw9O_zJk87CyJTI4kLzQwERAB_326xlEx_AuRyC8ACL_U8q_475h-En03-kja25FdsV2AxRXle-wGmElW7IxN6Z5AhsSpisZFMa0WKVXMsyI-zT3cPvPscbe54HtvFNeBwczVIJwA2Qq489cmmnccnfYDS20DhzZzRdXpOpcwl_6mNY2GuWnu1atCRz0hOIqN4zuvua8Gg9EwYx0BHXr4cmyIH-B5wQ-na-ZYAq9tRhR_9W3l8qg7xqUwKTSN89eBv7D-OlRfFCNAXrQ';
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($token));
    }

    public function testRS384()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $decoder = new Decoder('TEST', $keyStorage);

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzM4NCJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.LYk8m8cjYiJ2Hfef-hqgHhno9C_qp1SB4TWqHYTNLvSpZD2tH0Wsu-ATBVY2OdkEEoOJhVZGLWksnB7mWmDixybDK6UHj4gur_LZBd1YvWjUqB7Gee5bnciDAOteRVaP8c_f5YVXYGParFc6PVveY-EybG9ej0sukjAZenodeMOPMh8ooUCzcD4UUa3NnjyCu8sTk1cUGTEVca64BZmNirXj88GMmpDGqcNovHItjmhqtvKmRyGP4MVorG2pgy06kRkwPyXOF4X3SwW6gh_OsUF6QN-__N1DdSraFa_dDnunopxXhfBLKHeeywX4yC7DcNci3IVXq2J7NyqCJIuqPw';
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($token));
    }

    public function testRS512()
    {
        $keyStorage = new KeyStorage('00000000000000000000000000000000', JWT_CERT, JWT_KEY);
        $decoder = new Decoder('TEST', $keyStorage);

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.cXZCCqSA43zdqr3z1VgWuzBIw9gACkmMxicuelkJ1wpy4HzG2ws_UF6Acib2oCYZFgY9gsc9HdzxffhmskEPOiwQyPPjxjg91RszFLdk-iKxdxQOXttKud8MmIs4brP1X9zZJtGyhteNaFmtVsl-sj7bJ5aYv7Epnk5GDodxzysFath5O4RdRe7VF7_DRaPJ3C3-DpoHYK1b8XHc2Lpl-eQls2bKEOnle_jd-N6zTJOJTgRe2KSjrKJweMu3oa0Qe1jGMFXYZbnxop7o-J8AOM6Pb9dBbybilBB1Ah-R0v4JPJsuOl805svtItkRGAb_tCIRtBdGjtpi1F-_0gh1Gw';
        $expectedPayload = ['username' => 'John Doe'];

        $this->assertEquals($expectedPayload, $decoder->decode($token));
    }
}
